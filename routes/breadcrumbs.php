<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for (
    'teacher.index', function (BreadcrumbTrail $trail) {
        $trail->push('Teacher', route('teacher.index'));
    }
);
Breadcrumbs::for (
    'teacher.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('teacher.index');
        $trail->push('Create teacher', route('teacher.create'));
    }
);

Breadcrumbs::for (
    'teacher.edit', function (BreadcrumbTrail $trail, $teacher): void {
        $trail->parent('teacher.index');
        $trail->push('Editing' . ' > ' . $teacher, route('teacher.edit', [$teacher]));
    }
);

Breadcrumbs::for (
    'student.index', function (BreadcrumbTrail $trail) {
        $trail->push('Students', route('student.index'));
    }
);
Breadcrumbs::for (
    'student.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('student.index');
        $trail->push('Create student', route('student-.reate'));
    }
);

Breadcrumbs::for (
    'class.index', function (BreadcrumbTrail $trail) {
        $trail->push('Class', route('class.index'));
    }
);
Breadcrumbs::for (
    'class.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('class.index');
        $trail->push('Create class', route('class.create'));
    }
);
Breadcrumbs::for (
    'class.edit', function (BreadcrumbTrail $trail, $class): void {
        $trail->parent('class.index');
        $trail->push('Editing' . ' > ' . $class, route('class.edit', [$class]));
    }
);


Breadcrumbs::for (
    'level.index', function (BreadcrumbTrail $trail) {
        $trail->push('Levels', route('level.index'));
    }
);
Breadcrumbs::for (
    'level.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('level.index');
        $trail->push('Create Level', route('level.create'));
    }
);
Breadcrumbs::for (
    'level.edit', function (BreadcrumbTrail $trail, $level_id): void {
        $trail->parent('level.index');
        $trail->push('Editing' . ' > ' . $level_id, route('level.edit', [$level_id]));
    }
);




Breadcrumbs::for (
    'section.index', function (BreadcrumbTrail $trail) {
        $trail->push('Sections', route('section.index'));
    }
);
Breadcrumbs::for (
    'section.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('section.index');
        $trail->push('Create Section', route('section.create'));
    }
);

Breadcrumbs::for (
    'section.edit', function (BreadcrumbTrail $trail, $slug): void {
        $trail->parent('section.index');
        $trail->push('Editing' . ' > ' . $slug, route('section.edit', [$slug]));
    }
);

Breadcrumbs::for (
    'subject.index', function (BreadcrumbTrail $trail) {
        $trail->push('Subjects', route('subject.index'));
    }
);
Breadcrumbs::for (
    'subject.create', function (BreadcrumbTrail $trail): void {
        $trail->parent('subject.index');
        $trail->push('Create Subject', route('subject.create'));
    }
);

Breadcrumbs::for (
    'subject.edit', function (BreadcrumbTrail $trail, $subject): void {
        $trail->parent('subject.index');
        $trail->push('Editing' . ' > ' . $subject, route('subject.edit', [$subject]));
    }
);