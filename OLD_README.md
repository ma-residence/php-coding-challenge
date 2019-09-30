# Symfony2 exercise

This is the repository with the exercise for the ma-residence interview.

Read the contents of this **README.md** carefully as it will help you to set up this exercise.

In this exercise, you will have to code a micro API using Symfony 2

## Getting started

### Prerequisites
This project uses all the classic stack tools needed for a SF2 project so you'll need

* a **web server with PHP** enabled
* a **SQL database** (for example MySQL)
* a **git** client to clone the sources
* the **composer** tool
* the **PHPUnit** testing tool (you can grab it [here](https://phpunit.de)), it's a simple PHP script which
can be run with a PHP interpreter (like **composer**)

### Clone the Project skeleton
This repository uses **git**, you should clone it on your machine through a git clone.

### Install the project
The project is set up to be installed through the **composer** tool.

The root of the project contains a *composer.json* file already configured. 
A simple `composer install` should install all the required dependencies.
Just after the dependencies installation, the command line should prompts you to configure
your Symfony2 parameters otherwise you can manually configure the project with the correct command line.

### Check your system configuration
After having set up your project, confirm that your `app/config/parameters.yml` has the correct parameters.
The most important parameters are the database related parameters.

Be sure that you have created the correct database for your project.

### The 'src/ExerciseBundle'
The *src/ExerciseBundle* located in the *src* folder is where you will work. The bundle has already been registered
in the *app/AppKernel.php* and the *app/config/routing.yml* is already configured (you can check it yourself).

## It's up to you now!
Now read the **INSTRUCTIONS.md** file located at the root of the project. It contains all the instructions and hints
for the project.

You can of course do several commits during the test to save your work. We'll look at the final result only.

## Submitting your solution
To submit your solution, you can simply push your work into the repository (it's been made only for you).


## How you will be evaluated
A bunch of tests have been written under the *src/ExerciceBundle/Tests*

### Controllers Tests
Those tests are functional tests. They will test your API endpoints, the responses etc...

### Services Tests
This folder contains a unit test which will test the final result using a test dataset

### Procedure which will be executed to test your solution
* We will clone your sources
* We will set up the Symfony project
* We will import the database structure with the doctrine tool `php app/console doctrine:schema:update --force`
* We will launch the tests with PHP Unit `phpunit -c app/`

### About the results
The results are important but there is no unique solution, there are various way to pass the tests successfully.
We prefer a not so perfect solution than no solution at all even if you have to change a little bit the structure of the project.

**Don't forget that you will have to explain and justify your choices during an interview. This exercise is mainly a way
to provide discussion material for it.**
