#noinspection CucumberUndefinedStep
Feature: It is possible to generate basic crud actions for an entity
  Scenario: Generate an add action
    When I run the command "generate:backend:action:add" and I provide as input
      """
      TestModule[enter]MyTestEntity[enter]Backend\Modules\TestModule\Domain\MyTestEntity[enter]
      """
    Then the command has finished successfully
    And the file "src/Backend/Modules/TestModule/Actions/MyTestEntityAdd.php" should be dumped and look like "../generate/backend/resources/php71/Backend/Modules/TestModule/Actions/MyTestEntityAdd.php"
    And the file "src/Backend/Modules/TestModule/Layout/Templates/MyTestEntityAdd.html.twig" should be dumped and look like "../generate/backend/resources/php71/Backend/Modules/TestModule/Layout/Templates/MyTestEntityAdd.html.twig"
