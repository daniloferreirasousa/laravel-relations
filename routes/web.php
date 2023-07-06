<?php

use Illuminate\Support\Facades\Route;
use App\Models\{
    User,
    Preference,
    Permission
};

use App\Models\Course\{
    Course,
    Module,
    Lesson
};
use App\Models\Polimorfic\{
    Comment
};

/**
 * Relacionamento Um Para Um
 */
Route::get('/one-to-one', function () {
    $user = User::with('preference')->first();

    $data = [
        'notify_emails' => false,
        'notify' => true,
        'background_color' => '#f9f9f9'
    ];

    if($user->preference) {
        $user->preference->update($data);
    } else {
        // $user->preference()->create($data);

        $preference = new Preference($data);
        $user->preference()->save($preference);
    }

    $user->refresh();

    dd($user->preference);
});

/**
 * Relacionamento Um Para Muitos
 */
Route::get('/one-to-many', function() {
    // $course = Course::create(['name' => 'Relacionamentos Laravel', 'available' => true]);

    $course = Course::with('modules.lessons')->first();


    // $data = [
    //     'name' => 'One To One'
    // ];

    // $data = [
    //     'name' => 'Aula 1',
    //     'url' => 'http://localhost:8989/one-to-many'
    // ];

    // $course->modules()->create($data);

    // $module = Module::with('lessons')->first();

    // $module->lessons()->create($data);

    // $course->refresh();

    echo "Curso: " . $course->name . "<br>";

    echo "<ul>";
    foreach($course->modules as $module) {
        echo "<li>";
        echo $module->name;

        echo "<ul>";
            foreach($module->lessons as $lesson) {
                echo "<li> <a href='".$lesson->url."'>" . $lesson->name . "</a></li>";
            }
            echo "</ul>";
        echo "</li>";
    }
    echo "</ul>";
});

/**
 * Relacionamento Muitos Para Muitos
 */
Route::get('/many-to-many', function() {
    $user = User::with('permissions')->find(1);

    $permission = Permission::find(1);
    // $user->permissions()->save($permission);
    // $user->permissions()->saveMany([
    //     Permission::find(2),
    //     Permission::find(3)
    // ]);
    $user->permissions()->sync([1]);
    // $user->permissions()->attach([2, 3]);
    // $user->permissions()->detach([1, 2]);




    $user->refresh();


    dd($user->permissions);
});

/**
 * Relacionamento Pivot - Muitos para Muitos
 */
Route::get('/many-to-many-pivot', function() {
    $user = User::with('permissions')->find(1);
    $user->permissions()->sync([
        1 => ['active' => true],
        2 => ['active' => false],
        4 => ['active' => true]
    ]);
    
    // $user->permissions()->delete();

    $user->refresh();

    echo "<b>{$user->name}</b><hr> Permissões:<br>";
    foreach($user->permissions as $permission) {
        echo "{$permission->name} - {$permission->pivot->active}<br>";
    }
});

/**
 * Relacionamento One To One - Polimórfico
 */
Route::get('/one-to-one-polimorfic', function() {
    $user = User::find(3);

    $data = [
        'path' => 'images/user3-image.png'
    ];

    if($user->image) {
        $user->image->update($data);
    } else {
        $user->image()->create($data);
    }

    $user->refresh();

    dd($user->image);
});

/**
 * Relacionamento One To Many - Polimórfico
 */
Route::get('/one-to-many-polimorfic', function() {
    // $course = Course::first();

    // $course->comments()->create([
    //     'subject' => 'Segundo comentário',
    //     'body' => 'Esté é meu Segundo comentário utilizando o One to Many Polimórfico.'
    // ]);

    // dd($course->comments);
    $comment = Comment::find(1);

    dd($comment->commentable);
});


/**
 * Relacionamento Many To Many - Polimórfico
 */
Route::get('/many-to-many-polimorfic', function() {
    
});
Route::get('/', function () {
    return view('welcome');
});
