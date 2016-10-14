# drunit7
A basic set of unit test cases to verify current custom configuration in a Drupal 7 instance.

## Requirements

   - drunit7 requires phpunit ^5.4.8.
   - If you do not have phpunit installed you can download and install it with composer with the next command: ```composer global require 'phpunit/phpunit=5.5.*'```,
more information about can be found in https://getcomposer.org/ 
   - You also can download from the website, for more information visit: https://phpunit.de/
 
## Considerations
 
  Test cases are based on match config values on the database vs config values in a json files, those files must to be filled with the configuration that is pretended to test (samples are available in ```conf/```), by now the files accepted are:
  
  - content.types.test.json
  - contexts.test.json
  - date.formats.test.json
  - entities.test.json
  - formats.test.json
  - image.styles.test.json
  - menus.test.json
  - modules.test.json
  - roles.test.json
  - themes.test.json
  - views.test.json
  - vocabulary.test.json
  
## Getting Started
 
 1. Fill the next variables inside the ```conf/config.ini.``` file:
   1. ```DRUPAL_ROOT``` with the path where you drupal instance is located
   1. ```JSON_FILES``` with the path where all json config files are located.
 2. Put the configuration to test in the proper json file. (samples available in ```conf/```).
 3. run ```phpunit Drunit7.php``` 
