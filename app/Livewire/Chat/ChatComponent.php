<?php

namespace App\Livewire\Chat;

use App\Events\LiveChatEvent;
use App\Events\liveNotifications;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ChatNotifications;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChatComponent extends Component
{


    // only users with previous chat
    public $searched_user;
    // global user search 
    public $searched_contact;
    // message that need to be sent
    public $message;

    #[Validate('exists:chats,id', onUpdate: false)]
    public $selected_chat;

    public $all_messages;

    public $highlighted_chat = [];


    public $user_notifcation;
    function mount()
    {
        if (Session::has('current_chat')) {
            $current_session_chat_id = Session::get('current_chat');
            $chat_messages = Chat::where('id', $current_session_chat_id->id)
                ->with('user', 'contact', 'message')
                ->first();

            // loading all messages for specific chat
            $this->all_messages = $chat_messages;
            // pre-select chat that was previously selected
            $this->selected_chat = $chat_messages->id;
            Session::put('chat_id', $this->selected_chat);

            // dispatching an event to javascript to get all the chat in real-time
            $this->dispatch('ChatUpdated', chat_id: $this->selected_chat);
        }

        Session::has('highlighted_chat')
            ? $this->highlighted_chat = Session::get('highlighted_chat')
            : null;

        $this->user_notifcation = Auth::user()->notifications->groupBy('data')->all();
    }

    #[Computed]
    function users()
    {
        if (!is_null($this->searched_contact)) {
            $user = User::Search($this->searched_contact)->get();
            return $user;
        }
    }

    #[Computed]
    function chats()
    {
        $chats = Chat::currentUserChats()
            ->with('contact:id,name,email,profile_photo_path')
            ->when(!is_null($this->searched_user), function ($query) {
                $query->Search($this->searched_user);
            })
            ->get();
        // dd($chats->toArray());
        return $chats;
    }

    function newChat($user_id)
    {
        if ($user_id) {
            $user = User::where('id', $user_id)->exists();
            if ($user) {
                $chat_exists = Chat::isTherePreviousChat($user_id);
                if (!$chat_exists) {
                    $chat = Chat::create([
                        'user_id' => Auth::user()->id,
                        'contact_id' => $user_id
                    ]);
                    $this->selected_chat = $chat->id;
                    $this->dispatch('close-modal');
                    $this->reset('searched_user');
                }
                // $this->reset();
            }
        }
    }

    function messages($chat_id)
    {

        $this->reset('message');
        try {
            DB::beginTransaction();
            if ($chat_id) {
                $chat_messages = Chat::where('id', $chat_id)
                    ->with('user', 'contact', 'message')
                    ->first();
                if (isset($chat_messages)) {
                    if (Session::has('current_chat')) {
                        Session::put('current_chat', $chat_messages);
                        $this->all_messages = $chat_messages;
                        $this->selected_chat = $chat_messages->id;
                        // dispathcing event for live chat listeners in javascript
                        $this->dispatch('ChatUpdated', chat_id: $chat_id);
                    } else {
                        Session::put('current_chat', $chat_messages);
                        // dispathcing event for live chat listeners in javascript
                        $this->dispatch('ChatUpdated', chat_id: $chat_id);
                        $this->all_messages = $chat_messages;
                    }
                }

                // when user click on the chat , the previous un-read messages should be read now
                $chat_notification = Auth::user()
                    ->notifications()
                    ->whereRaw('JSON_EXTRACT(data , "$.chat_id") = ? ', $chat_id)
                    ->get();
                // deleteing every notification from this chat
                if ($chat_notification) {
                    foreach ($chat_notification as $single_notification) {
                        $single_notification->delete();
                    }
                }
                // unset the notification from the session data.
                unset($this->highlighted_chat[$chat_id]);
                Session::put('highlighted_chat', $this->highlighted_chat);

            }
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            Notification::make()
                ->title('something went wrong.')
                ->danger()
                ->color('danger')
                ->duration(3000)
                ->send();
        }
    }

    function send()
    {

        if ($this->message && $this->selected_chat) {
            $message = Message::create([
                'chat_id' => $this->selected_chat,
                'sender_id' => Auth::user()->id,
                'message' => $this->message
            ]);

            $sender = User::where('id', Auth::user()->id)->first();
            if ($sender) {
                if (Session::has('current_chat')) {
                    $chat = Session::get('current_chat');
                    // makeing sure that we are sending the notification to the correct user , which is the one who recevied the message not who sent it.
                    if ($chat->contact_id == Auth::user()->id) {
                        $chat->user->notify(new ChatNotifications($this->selected_chat));
                        broadcast(new liveNotifications($chat->user->id, $chat));
                    } else {
                        // creating notification for the user
                        $chat->contact->notify(new ChatNotifications($this->selected_chat));
                        // real-time notificaion for the user
                        broadcast(new liveNotifications($chat->contact->id, $chat));
                    }

                }
                broadcast(new LiveChatEvent($this->selected_chat, $sender, $message->message))->toOthers();
            }
            $this->reset('message');
        } else {
            Notification::make()
                ->title('something went wrong, please try sending the messsage again')
                ->danger()
                ->color('danger')
                ->duration(2000)
                ->send();
        }
    }

    #[On('hightlight')]
    public function highLightMessage($id = null)
    {
        if ($id) {
            $this->highlighted_chat[$id] = $id;
            Session::put('highlighted_chat', $this->highlighted_chat);
        }
    }
    public function render()
    {
        // dd($this->send());
        return view('livewire.chat.chat-component');
    }
}