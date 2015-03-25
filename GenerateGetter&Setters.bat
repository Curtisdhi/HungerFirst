
@set /p entityPath= Enter entity's name: 
php app/console doctrine:generate:entities HyperionStudios\GxpBundle/Entity/%entityPath%
@PAUSE