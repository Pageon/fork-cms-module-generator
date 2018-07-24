#noinspection CucumberUndefinedStep
Feature: It is possible to generate a class for an entity
  Scenario:
    When I run the command "generate:domain:entity" and I provide as input
      """
      MyEntity[enter]Standalone[enter]MyEntity[enter][enter]
      """
    Then the command has finished successfully
    And the file "src/Standalone/MyEntity.php" should be dumped and look like "../generate/domain/resources/php71/Standalone/MyEntity.php"

  Scenario:
    When I run the command "generate:domain:entity" and I provide as input
      """
      MyEntityWithOneNullableParameter[enter]Standalone[enter]MyEntityWithOneNullableParameter[enter]y[enter]parameter1[enter][enter]1[enter][enter]
      """
    Then the command has finished successfully
    And the file "src/Standalone/MyEntityWithOneNullableParameter.php" should be dumped and look like "../generate/domain/resources/php71/Standalone/MyEntityWithOneNullableParameter.php"

  Scenario:
    When I run the command "generate:domain:entity" and I provide as input
      """
      MyEntityWithOneNotNullableParameter[enter]Standalone[enter]MyEntityWithOneNotNullableParameter[enter]y[enter]parameter1[enter][enter]0[enter][enter]
      """
    Then the command has finished successfully
    And the file "src/Standalone/MyEntityWithOneNotNullableParameter.php" should be dumped and look like "../generate/domain/resources/php71/Standalone/MyEntityWithOneNotNullableParameter.php"

  Scenario:
    When I run the command "generate:domain:entity" and I provide as input
      """
      MyEntityWithMultipleParameters[enter]Standalone[enter]MyEntityWithMultipleParameters[enter]y[enter]parameter1[enter][enter]0[enter]y[enter]parameter2[enter][enter]0[enter][enter]
      """
    Then the command has finished successfully
    And the file "src/Standalone/MyEntityWithMultipleParameters.php" should be dumped and look like "../generate/domain/resources/php71/Standalone/MyEntityWithMultipleParameters.php"
