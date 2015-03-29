
@set /p entityPath= Enter entity's name: 
php app/console doctrine:generate:entities HungryFirst/HFBundle/Entity/%entityPath%
@PAUSE