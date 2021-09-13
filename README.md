Here's the project.  I am calling it a week.


I made some changes since my last commit:

Fixed App\Http\Livewire\User
Fixed the buttons on create.blade.php
Added an outline to buttons on hover in main.css


tl;dr

1. I made the password hotfix a little more presentable, and the logic more coherent in App\Http\Livewire\User
2. I added logic that allows the show method to execute when the data is empty, so that newly created resources don't cause problems when clicking show.
3. Some very minor stylistic improvements.

So much to do.  Every app is a new challenge.  Thank you for this project.  I really enjoyed getting a good look at Livewire.  

Self assessment:

1. Hammering the delete button still causes failure.  Livewire ships with easy debouncing, but I couldn't get it going.  Maybe this is an edge case.
2. I wanted to do more with AG-Grid.  I wanted to generate charts with the show method, but I'll save that for another day.  From what I can tell, Livewire isn't really primed for third party libraries, which is one advantage that Inertia has. I think I got basic CRUD covered.
3. I left a TODO in App\Http\Livewire\User.  Basically, it seems like the app should a temporary password generator which the user is required to change at login.  But that seems beyond the scope of this project.

Here are instructions for deploying this app to localhost


1. ``git clone /github/url``
2. navigate to app root  ``cd /path/to/app ``
3. run ``composer install``
4. configure database with test user and schema
5. run ``php artisan migrate``
6. run ``php artisan key:generate``
7. run ``npm install``
8. run ``npm run dev``
9. run ``php artisan storage:link``
10. run ``php artisan db:seed --class=UserSeeder``


<h4>Self Assessment</h4>

This app has taken some liberties in the interest of time:

1. images are stored in version control.  I wouldn't do that with serious development
2. in ``app/database/factories``, I did not write everything to O(n1).  The deadline is short and Faker doesn't really affect perfomance
3. The HTML template was not as attractive as I had hoped.
4. Hammering the delete button causes an error if the resource is deleted before you press the button.  Certainly fixable but time is a constraint.
5. Creative Commons requires attribution, which can be found in an html file called credits.html, in public/storage/images
6. I wanted to the app look more attractive, to do more accessors and mutators, and to do more with the Show method, but times up!


``` ADDING FEATURES ```

As of September 9, 2021, I have added some features to improve the app.

1. I casted JSON datatype as an array.  This is kind of native accessor/mutator feature of Laravel.
2. I made some improvements to the UI.
3. I added an accessor to the User model that will format a ten digit phone number to be compatible with Laravel's SMS notifiable features.



Thanks for this project
