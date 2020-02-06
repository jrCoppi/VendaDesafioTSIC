<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase
{
    protected $traceError = true;
    
    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }

    
    public function testAdminActionCanBeAccessed()
    {
        $this->dispatch('/admin/get', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('admin/get');
    }

    public function testAdminActionIsSucess()
    {
        $this->dispatch('/admin/get', 'GET');

        //busca o json de retorno
        $content  = $this->getResponse()->getContent();
        $content = json_decode($content);
        /*$this->expectOutputString(''); var_dump(empty($content->dados)); */
        
        //verifica se tem os dados padrões de retorno
        $this->assertArrayHasKey('mensagem',json_decode(json_encode($content), true));
        $this->assertArrayHasKey('sucesso',json_decode(json_encode($content), true));
        $this->assertArrayHasKey('dados',json_decode(json_encode($content), true));

        //verifica se tem sucesso no retorno
        $this->assertEquals(true,$content->sucesso);

        //verifica se existem dados
        $this->assertEquals(false,empty($content->dados));
    }

    public function testInvalidRouteDoesNotCrash()
    {
        $this->dispatch('/invalid/route', 'GET');
        $this->assertResponseStatusCode(404);
    }
}
