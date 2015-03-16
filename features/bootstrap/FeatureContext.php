<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
    /**
     * @Given /^I am in a directory "([^"]*)"$/
     * @param type $dir
     */
    public function iAmInADirectory($dir) 
    {
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        
        chdir($dir);
    }
    
    /**
     * @Given /^I have a file named "([^"]*)"$/
     * @param type $file
     */
    public function iHaveAFileNamed($file)
    {
        touch($file);
    }
    
    /**
     * @When /^I run "([^"]*)"$/
     * @param type $command
     */
    public function iRun($command)
    {
        exec($command, $output);
        
        $this->output = trim(implode("\n", $output));
    }
    
    /**
     * @Then /^I should get:$/
     * @param PyStringNode $string
     */
    public function iShouldGet(PyStringNode $string)
    {
        if ((string) $string !== $this->output) {
            throw new Exception(
                    "Actual output is: \n" . $this->output
            );
        }
    }
}
