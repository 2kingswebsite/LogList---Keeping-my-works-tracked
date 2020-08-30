<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About The Project

As a freelancer, i usually track my work on a notepad, writing down what i have done so far in a project, putting a difficulty level to the accomplished tasks, and put a price,
But most of the time , i came accross to a lot of projects , with other collaborators, that we should track each one's tasks,
<br>
So that pushed me to build a simple tracking system 
<br>
A system build with Laravel , and Ajax for Loading data,
<br>
In this system you can :
   <ul>
    <li>Create An Account</li>
    <li>Create a Project</li>
    <li>Add a Collaborator to your project</li>
    <li>Create tasks in your Project</li>
    <li>Edit your tasks</li>
    <li>Delete the canceled taskes</li>
    <li>...Still Other Ideas in the works</li>
   </ul>

## Rules to add a collaborator
The system was designed to coordinate accomplished task between collaborator
<br>
to add a Collaborator , you need to ask your guest to generate a token, (you will find a button named " Allow others to add me" on the Projects list page)
generate a new one , and send you his token.
<br>
paste the generated token on the "add collaborate" (check in project's tasks page)
<br>
then request an invitation

## Issues
<dl>
    <dt>when create a new task, the total spent and amount and total tasks won't get updated</dt>
        <dd>briefly the issue is in Ajax, since i can only return view without other values to ajax</dd>
    <dt>when Edit a task</dt>
        <dd>same issue with create, to compare that i can return multiple value to ajax ,check delete function</dd>
        <dd>detele function return only variable, and i didnt include a view, thats why it works</dd>
</dl>


## To update
<ul>
    <li>deny access if user isn't logged in</li>
    <li>delete home route</li>
    <li>show analetics in project's tasks, like all collaborator's analetics throught the project </li>
</ul>

## New Goals
<ul>
    <li>print into microsoft word, or excel..</li>
    <li>make a messaging system</li>
    <li>show analetics in project's tasks, like all collaborator's analetics throught the project </li>
    <li></li>
</ul>

## Neglected Parts
The projects won't include a system payment, it's just a tool to help creators like me to track their works, 
<br>
speaking about the payment, it's about the trust in your team
<br>
i include some other neglected Parts
<ul>
    <li>Design and responsivity</li>
    <li>portability</li>
    <li>not Using Ajax in all data circulation</li>
</ul>


## Project History
Started it in : 20/08/2020 , after learning more about Ajax, also due to some difficulties on my freelancing path
<br>
Deployed on github : 30/08/2020 after working 12 hours to build it 



## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
 
