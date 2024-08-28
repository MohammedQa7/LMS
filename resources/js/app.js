import './bootstrap';
import "flowbite";
import { initFlowbite } from 'flowbite';

document.addEventListener('livewire:navigated', () => {
    Livewire.on('initFlowbite', () => {
        initFlowbite();
    })
    Livewire.hook('message.processed', (message, component) => {
        console.log('test');

    });
    initFlowbite();
});