<?php

use Illuminate\Support\Facades\Route;
use App\Models\{
    User,
    Preference
};

use App\Models\Course\{
    Course,
    Module,
    Lesson
};

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

Route::get('/one-to-many', function() {
    // $course = Course::create(['name' => 'Relacionamentos Laravel', 'available' => true]);

    $course = Course::with('modules.lessons')->first();


    // $data = [
    //     'name' => 'One To One'
    // ];

    $data = [
        'name' => 'Aula 1',
        'url' => 'http://localhost:8989/one-to-many'
    ];

    //$course->modules()->lessons()->create($data);
    // $course->modules()->create($data);

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




    // dd($modules);
});

Route::get('/', function () {
    return view('welcome');
});
