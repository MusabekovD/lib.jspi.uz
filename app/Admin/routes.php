<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@chart')->name('admin.home');
    $router->resource('education-years', educationYearsController::class);
    $router->resource('departments', departmentController::class);
    $router->resource('categories-books', CategoryBooksController::class);
    $router->resource('books-lessons', BooksLessonAndManualController::class);
    $router->resource('science', ScienceController::class);
    $router->resource('menus', MenusController::class);
    $router->resource('books', BooksController::class);
    $router->resource('langs', LangsController::class);
    $router->resource('authors', AuthorsController::class);
    $router->resource('publishings', PublishingController::class);
    $router->resource('search-keywords', SearchKeywordsController::class);
    $router->resource('members', MembersController::class);
    $router->resource('appeals', AppelasController::class);
    $router->resource('kitob-buyurtmas', BuyurtmaController::class);
    $router->post('upload', 'HomeController@upload');
    $router->resource('news', NewsController::class);
    $router->resource('pages', PagesController::class);

    $router->get('/api/authors', 'ApiController@authors')->name('admin.authors');
    $router->get('/api/publishings', 'ApiController@publishings')->name('admin.publishings');
    $router->get('/api/sciences', 'ApiController@getSciencesByDepartments')->name('admin.getSciencesByDepartments');




    $router->get('lessons/{id}/viewhistory', 'LessonsController@history')->name('admin.chart');
    $router->resource('students', StudentsController::class);
    $router->resource('lessons', LessonsController::class);
    $router->resource('topics', TopicsController::class);
    $router->resource('questions', QuestionsController::class);
    $router->get('questions/create/{id}', 'QuestionsController@add')->name('questions.add');
    $router->get('topics/send/{id}', 'TopicsController@send')->name('topics.send');
    $router->get('topics/results/{id}', 'TopicsController@resultTest')->name('topics.results');
    $router->get('topics/questions/{id}', 'TopicsController@questions')->name('topics.questions');
    $router->get('topics/questions/variantlar/{id}', 'TopicsController@variantlar')->name('topics.variantlar');

    $router->get('lessons/viewhistory/{id}', 'LessonsController@results')->name('topics-results');
    $router->post('questions/storedata', 'QuestionsController@storedata')->name('questions.storedata');

    $router->resource('savol-students', QuestionsStudentsController::class);
});
