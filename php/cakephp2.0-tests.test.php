<?php
define('RUNNING_TESTS', true);
require __DIR__ . '/cakephp2.0-tests.php';

class Cakephp20HookTest extends PHPUnit_Framework_TestCase {

	function testNonPhpFiles() {

		$result = testCase('.gitignore');
		$this->assertFalse($result);

		$result = testCase('empty');
		$this->assertFalse($result);

		$result = testCase('some.sh');
		$this->assertFalse($result);

		$result = testCase('textfile.txt');
		$this->assertFalse($result);

	}

	function testAppFiles() {

		$result = testCase('View/Helper/BananaHelper.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('View/Helper/BananaHelper', $result['case']);
		$this->assertEquals('Test/Case/View/Helper/BananaHelperTest.php', $result['testFile']);

		$result = testCase('Lib/Cache/Engine/TestAppCacheEngine.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Cache/Engine/TestAppCacheEngine', $result['case']);
		$this->assertEquals('Test/Case/Lib/Cache/Engine/TestAppCacheEngineTest.php', $result['testFile']);

		$result = testCase('Lib/Utility/TestUtilityClass.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Utility/TestUtilityClass', $result['case']);
		$this->assertEquals('Test/Case/Lib/Utility/TestUtilityClassTest.php', $result['testFile']);

		$result = testCase('Lib/Library.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Library', $result['case']);
		$this->assertEquals('Test/Case/Lib/LibraryTest.php', $result['testFile']);

		$result = testCase('Lib/Log/Engine/TestAppLog.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Lib/Log/Engine/TestAppLog', $result['case']);
		$this->assertEquals('Test/Case/Lib/Log/Engine/TestAppLogTest.php', $result['testFile']);

		$result = testCase('Controller/TestsAppsController.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Controller/TestsAppsController', $result['case']);
		$this->assertEquals('Test/Case/Controller/TestsAppsControllerTest.php', $result['testFile']);

		$result = testCase('Controller/TestsAppsPostsController.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Controller/TestsAppsPostsController', $result['case']);
		$this->assertEquals('Test/Case/Controller/TestsAppsPostsControllerTest.php', $result['testFile']);

		$result = testCase('Console/Command/SampleShell.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Console/Command/SampleShell', $result['case']);
		$this->assertEquals('Test/Case/Console/Command/SampleShellTest.php', $result['testFile']);

		$result = testCase('Console/templates/test/classes/test_object.ctp');
		$this->assertFalse($result);

		$result = testCase('Model/PersisterTwo.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/PersisterTwo', $result['case']);
		$this->assertEquals('Test/Case/Model/PersisterTwoTest.php', $result['testFile']);

		$result = testCase('Model/PersisterOne.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/PersisterOne', $result['case']);
		$this->assertEquals('Test/Case/Model/PersisterOneTest.php', $result['testFile']);

		$result = testCase('Model/Comment.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Comment', $result['case']);
		$this->assertEquals('Test/Case/Model/CommentTest.php', $result['testFile']);

		$result = testCase('Model/Post.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Post', $result['case']);
		$this->assertEquals('Test/Case/Model/PostTest.php', $result['testFile']);

		$result = testCase('Model/Behavior/PersisterTwoBehaviorBehavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Behavior/PersisterTwoBehaviorBehavior', $result['case']);
		$this->assertEquals('Test/Case/Model/Behavior/PersisterTwoBehaviorBehaviorTest.php', $result['testFile']);

		$result = testCase('Model/Behavior/PersisterOneBehaviorBehavior.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Behavior/PersisterOneBehaviorBehavior', $result['case']);
		$this->assertEquals('Test/Case/Model/Behavior/PersisterOneBehaviorBehaviorTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Session/TestAppLibSession.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Session/TestAppLibSession', $result['case']);
		$this->assertEquals('Test/Case/Model/Datasource/Session/TestAppLibSessionTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Test2Source.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Test2Source', $result['case']);
		$this->assertEquals('Test/Case/Model/Datasource/Test2SourceTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Database/TestLocalDriver.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Database/TestLocalDriver', $result['case']);
		$this->assertEquals('Test/Case/Model/Datasource/Database/TestLocalDriverTest.php', $result['testFile']);

		$result = testCase('Model/Datasource/Test2OtherSource.php');
		$this->assertEquals('app', $result['category']);
		$this->assertEquals('Model/Datasource/Test2OtherSource', $result['case']);
		$this->assertEquals('Test/Case/Model/Datasource/Test2OtherSourceTest.php', $result['testFile']);

	}

	function testPluginFiles() {

		$result = testCase('plugins/test_plugin_two/Console/Command/example.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('Console/Command/example', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/Test/Case/Console/Command/exampleTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin_two/Console/Command/welcome.php');
		$this->assertEquals('test_plugin_two', $result['category']);
		$this->assertEquals('Console/Command/welcome', $result['case']);
		$this->assertEquals('plugins/test_plugin_two/Test/Case/Console/Command/welcomeTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Config/schema/schema.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/Config/load.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/Config/more.load.php');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/layouts/default.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/Helper/OtherHelperHelper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/OtherHelperHelper', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/View/Helper/OtherHelperHelperTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/Helper/test_plugin_app.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/test_plugin_app', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/View/Helper/test_plugin_appTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/Helper/plugged_helper.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('View/Helper/plugged_helper', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/View/Helper/plugged_helperTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/View/Test/scaffold.form.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/Test/index.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/elements/plugin_element.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/View/elements/test_plugin_element.ctp');
		$this->assertFalse($result);

		$result = testCase('plugins/test_plugin/Lib/test_plugin_library.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/test_plugin_library', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Lib/test_plugin_libraryTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Cache/Engine/TestPluginCacheEngine.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Cache/Engine/TestPluginCacheEngine', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Lib/Cache/Engine/TestPluginCacheEngineTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Custom/Package/CustomLibClass.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Custom/Package/CustomLibClass', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Lib/Custom/Package/CustomLibClassTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Error/TestPluginExceptionRenderer.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Error/TestPluginExceptionRenderer', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Lib/Error/TestPluginExceptionRendererTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Lib/Log/Engine/TestPluginLog.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Lib/Log/Engine/TestPluginLog', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Lib/Log/Engine/TestPluginLogTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/test_plugin_app_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/test_plugin_app_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/test_plugin_app_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/test_plugin_other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/test_plugin_other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/Component/test_plugin_other_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/other_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/other_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/Component/other_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/plugins_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/plugins_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/Component/plugins_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Component/test_plugin_component.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Component/test_plugin_component', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/Component/test_plugin_componentTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/test_plugin_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/test_plugin_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/test_plugin_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Controller/Test_controller.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Controller/Test_controller', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Controller/Test_controllerTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Console/Command/example.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Console/Command/example', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Console/Command/exampleTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Console/Command/Task/other_task.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Console/Command/Task/other_task', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Console/Command/Task/other_taskTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_auth_user.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_auth_user', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/test_plugin_auth_userTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_app_model.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_app_model', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/test_plugin_app_modelTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/TestPluginPost.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/TestPluginPost', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/TestPluginPostTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_authors.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_authors', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/test_plugin_authorsTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Behavior/test_plugin_persister_one.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Behavior/test_plugin_persister_one', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Behavior/test_plugin_persister_oneTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Behavior/test_plugin_persister_two.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Behavior/test_plugin_persister_two', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Behavior/test_plugin_persister_twoTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/TestSource.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/TestSource', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Datasource/TestSourceTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Session/TestPluginSession.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Session/TestPluginSession', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Datasource/Session/TestPluginSessionTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/test_other_source.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/test_other_source', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Datasource/test_other_sourceTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Database/DboDummy.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Database/DboDummy', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Datasource/Database/DboDummyTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/Datasource/Database/TestDriver.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/Datasource/Database/TestDriver', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/Datasource/Database/TestDriverTest.php', $result['testFile']);

		$result = testCase('plugins/test_plugin/Model/test_plugin_comment.php');
		$this->assertEquals('test_plugin', $result['category']);
		$this->assertEquals('Model/test_plugin_comment', $result['case']);
		$this->assertEquals('plugins/test_plugin/Test/Case/Model/test_plugin_commentTest.php', $result['testFile']);

	}

	function testCoreFiles() {

		$result = testCase('lib/Cake/Cache/Engine/ApcEngine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/ApcEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/ApcEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Cache/Engine/XcacheEngine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/XcacheEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/XcacheEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Cache/Engine/FileEngine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/FileEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/FileEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Cache/Engine/MemcacheEngine.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/MemcacheEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/MemcacheEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Cache/Cache.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Cache', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/CacheTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Folder.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Folder', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/FolderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Inflector.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Inflector', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/InflectorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Security.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Security', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SecurityTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/ClassRegistry.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/ClassRegistry', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ClassRegistryTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Debugger.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Debugger', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/DebuggerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Xml.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Xml', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/XmlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Validation.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Validation', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ValidationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/ObjectCollection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/ObjectCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ObjectCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Set.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Set', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SetTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/File.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/File', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/FileTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/Sanitize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Sanitize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SanitizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Utility/String.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/String', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/StringTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/ScaffoldView.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/ScaffoldView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/ScaffoldViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/View.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/View', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/ViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/HelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/ThemeView.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/ThemeView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/ThemeViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/HelperCollection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/HelperCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/HelperCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/TimeHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/TimeHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/TimeHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/RssHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/RssHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/RssHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/JsHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/JsHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/JsHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/PaginatorHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/PaginatorHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/PaginatorHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/TextHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/TextHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/TextHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/CacheHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/CacheHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/CacheHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/FormHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/FormHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/FormHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/PrototypeEngineHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/PrototypeEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/PrototypeEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/MootoolsEngineHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/MootoolsEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/MootoolsEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/AppHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/AppHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/AppHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/JsBaseEngineHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/JsBaseEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/JsBaseEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/SessionHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/SessionHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/SessionHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/JqueryEngineHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/JqueryEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/JqueryEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/HtmlHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/HtmlHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/HtmlHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/Helper/NumberHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/NumberHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/NumberHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/View/MediaView.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/MediaView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/MediaViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Configure/PhpReader.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Configure/PhpReader', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Configure/PhpReaderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Configure/IniReader.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Configure/IniReader', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Configure/IniReaderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestCase.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestCase', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestCaseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Reporter/CakeHtmlReporter.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Reporter/CakeHtmlReporter', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Reporter/CakeHtmlReporterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Reporter/CakeTextReporter.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Reporter/CakeTextReporter', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Reporter/CakeTextReporterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Reporter/CakeBaseReporter.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Reporter/CakeBaseReporter', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Reporter/CakeBaseReporterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/ControllerTestCase.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/ControllerTestCase', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/ControllerTestCaseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestSuiteDispatcher.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestSuiteDispatcher', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestSuiteDispatcherTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Coverage/HtmlCoverageReport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Coverage/HtmlCoverageReport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Coverage/HtmlCoverageReportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Coverage/TextCoverageReport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Coverage/TextCoverageReport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Coverage/TextCoverageReportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Coverage/BaseCoverageReport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Coverage/BaseCoverageReport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Coverage/BaseCoverageReportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestSuiteCommand.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestSuiteCommand', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestSuiteCommandTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Fixture/CakeTestFixture.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Fixture/CakeTestFixture', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Fixture/CakeTestFixtureTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Fixture/CakeFixtureManager.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Fixture/CakeFixtureManager', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Fixture/CakeFixtureManagerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/Fixture/CakeTestModel.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/Fixture/CakeTestModel', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/Fixture/CakeTestModelTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/menu.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/menu', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/menuTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/missing_connection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/missing_connection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/missing_connectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/footer.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/footer', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/footerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/phpunit.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/phpunit', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/phpunitTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/xdebug.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/xdebug', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/xdebugTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/templates/header.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/templates/header', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/templates/headerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestLoader.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestLoader', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestLoaderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestSuite.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestSuite', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestSuiteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/TestSuite/CakeTestRunner.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestRunner', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestRunnerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/bootstrap.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Bootstrap', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/BootstrapTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Core/App.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/App', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/AppTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Core/Configure.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/Configure', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/ConfigureTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Core/Object.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/Object', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/ObjectTest.php', $result['testFile']);

		$result = testCase('lib/Cake/basics.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Basics', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/BasicsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/SecurityComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/SecurityComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/SecurityComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/CookieComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/CookieComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/CookieComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/DigestAuthenticate.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/DigestAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/DigestAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/ActionsAuthorize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/ActionsAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/ActionsAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/BaseAuthenticate.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/BaseAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/BaseAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/BasicAuthenticate.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/BasicAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/BasicAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/ControllerAuthorize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/ControllerAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/ControllerAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/FormAuthenticate.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/FormAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/FormAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/CrudAuthorize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/CrudAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/CrudAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/Auth/BaseAuthorize.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/BaseAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/BaseAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/SessionComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/SessionComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/SessionComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/EmailComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/EmailComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/EmailComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/RequestHandlerComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/RequestHandlerComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/RequestHandlerComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/PaginatorComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/PaginatorComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/PaginatorComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/AuthComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/AuthComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/AuthComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component/AclComponent.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/AclComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/AclComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/CakeErrorController.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/CakeErrorController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/CakeErrorControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Component.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/PagesController.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/PagesController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/PagesControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/AppController.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/AppController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/AppControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/ComponentCollection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/ComponentCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ComponentCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Scaffold.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Scaffold', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ScaffoldTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Controller/Controller.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Controller', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/HelpFormatter.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/HelpFormatter', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/HelpFormatterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/TaskCollection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/TaskCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/TaskCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleInput.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleInput', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleInputTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleInputArgument.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleInputArgument', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleInputArgumentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleOptionParser.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleOptionParser', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleOptionParserTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleInputOption.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleInputOption', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleInputOptionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Shell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Shell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleInputSubcommand.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleInputSubcommand', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleInputSubcommandTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleErrorHandler.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleErrorHandler', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleErrorHandlerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/SchemaShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/SchemaShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/SchemaShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/ConsoleShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/ConsoleShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/ConsoleShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/TestsuiteShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/TestsuiteShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/TestsuiteShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/CommandListShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/CommandListShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/CommandListShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/UpgradeShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/UpgradeShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/UpgradeShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/ProjectTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ProjectTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ProjectTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/ModelTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ModelTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ModelTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/ExtractTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ExtractTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ExtractTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/ViewTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ViewTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ViewTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/TemplateTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/TemplateTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/TemplateTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/DbConfigTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/DbConfigTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/DbConfigTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/BakeTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/BakeTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/BakeTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/ControllerTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ControllerTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ControllerTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/FixtureTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/FixtureTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/FixtureTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/PluginTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/PluginTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/PluginTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/Task/TestTask.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/TestTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/TestTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/AclShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/AclShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/AclShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/ApiShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/ApiShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/ApiShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/BakeShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/BakeShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/BakeShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/Command/I18nShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/I18nShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/I18nShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ConsoleOutput.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleOutput', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleOutputTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/View/Helper/AppHelper.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/View/Helper/AppHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/View/Helper/AppHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/Controller/PagesController.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/Controller/PagesController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/Controller/PagesControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/Controller/AppController.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/Controller/AppController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/Controller/AppControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/Console/cake.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/Console/cake', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/Console/cakeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/index.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/index', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/indexTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/Model/AppModel.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/Model/AppModel', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/Model/AppModelTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/webroot/test.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/webroot/test', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/webroot/testTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/templates/skel/webroot/index.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/templates/skel/webroot/index', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/templates/skel/webroot/indexTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/cake.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/cake', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/cakeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/ShellDispatcher.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ShellDispatcher', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ShellDispatcherTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Console/AppShell.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/AppShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/AppShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Routing/Dispatcher.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Dispatcher', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/DispatcherTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Routing/Route/PluginShortRoute.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/PluginShortRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/PluginShortRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Routing/Route/RedirectRoute.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/RedirectRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/RedirectRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Routing/Route/CakeRoute.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/CakeRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/CakeRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Routing/Router.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Router', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/RouterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/AppModel.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/AppModel', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/AppModelTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/CakeSchema.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/CakeSchema', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/CakeSchemaTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Model.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Model', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/AclNode.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/AclNode', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/AclNodeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/ConnectionManager.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ConnectionManager', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ConnectionManagerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Aro.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Aro', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/AroTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Permission.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Permission', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/PermissionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/BehaviorCollection.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/BehaviorCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/BehaviorCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/ModelBehavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Behavior/ContainableBehavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/ContainableBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/ContainableBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Behavior/TranslateBehavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/TranslateBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/TranslateBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Behavior/TreeBehavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/TreeBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/TreeBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Behavior/AclBehavior.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/AclBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/AclBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Aco.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Aco', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/AcoTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/AcoAction.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/AcoAction', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/AcoActionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Session/CacheSession.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Session/CacheSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Session/CacheSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Session/DatabaseSession.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Session/DatabaseSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Session/DatabaseSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/CakeSession.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/CakeSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/CakeSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/DboSource.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/DboSource', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/DboSourceTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Database/Mysql.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Mysql', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/MysqlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Database/Postgres.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Postgres', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/PostgresTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Database/Sqlite.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Sqlite', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/SqliteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Database/Oracle.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Oracle', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/OracleTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/Database/Mssql.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Mssql', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/MssqlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Model/Datasource/DataSource.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/DataSource', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/DataSourceTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Cache/Engine/MemcacheTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/Memcache', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/MemcacheTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Cache/Engine/FileEngineTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/FileEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/FileEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Cache/Engine/XcacheTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/Xcache', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/XcacheTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Cache/Engine/ApcEngineTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Engine/ApcEngine', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/Engine/ApcEngineTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Cache/CacheTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Cache/Cache', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Cache/CacheTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/BasicsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Basics', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/BasicsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllNetworkTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllNetwork', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllNetworkTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/SecurityTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Security', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SecurityTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/ClassRegistryTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/ClassRegistry', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ClassRegistryTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/DebuggerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Debugger', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/DebuggerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/FolderTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Folder', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/FolderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/ValidationTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Validation', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ValidationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/SanitizeTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Sanitize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SanitizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/StringTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/String', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/StringTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/InflectorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Inflector', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/InflectorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/SetTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Set', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/SetTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/ObjectCollectionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/ObjectCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/ObjectCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/FileTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/File', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/FileTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Utility/XmlTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Utility/Xml', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Utility/XmlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/ViewTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/View', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/ViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/MediaViewTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/MediaView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/MediaViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/HelperCollectionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/HelperCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/HelperCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/PrototypeEngineHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/PrototypeEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/PrototypeEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/SessionHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/SessionHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/SessionHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/NumberHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/NumberHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/NumberHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/PaginatorHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/PaginatorHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/PaginatorHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/JqueryEngineHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/JqueryEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/JqueryEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/MootoolsEngineHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/MootoolsEngineHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/MootoolsEngineHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/CacheHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/CacheHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/CacheHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/HtmlHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/HtmlHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/HtmlHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/RssHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/RssHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/RssHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/JsHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/JsHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/JsHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/TimeHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/TimeHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/TimeHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/FormHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/FormHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/FormHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/Helper/TextHelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper/TextHelper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/Helper/TextHelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/HelperTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/Helper', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/HelperTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/View/ThemeViewTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('View/ThemeView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/View/ThemeViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllErrorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllError', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllErrorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllRoutingTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllRouting', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllRoutingTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllViewTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllView', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllViewTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllConfigureTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllConfigure', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllConfigureTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllCacheTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllCache', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllCacheTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Configure/PhpReaderTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Configure/PhpReader', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Configure/PhpReaderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Configure/IniReaderTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Configure/IniReader', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Configure/IniReaderTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/TestSuite/HtmlCoverageReportTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/HtmlCoverageReport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/HtmlCoverageReportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/TestSuite/CakeTestFixtureTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestFixture', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestFixtureTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/TestSuite/ControllerTestCaseTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/ControllerTestCase', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/ControllerTestCaseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/TestSuite/CakeTestCaseTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('TestSuite/CakeTestCase', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/TestSuite/CakeTestCaseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Core/ObjectTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/Object', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/ObjectTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Core/AppTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/App', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/AppTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Core/ConfigureTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Core/Configure', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Core/ConfigureTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllLogTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllLog', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllLogTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllTestsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllTests', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllTestsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/SessionComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/SessionComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/SessionComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/CookieComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/CookieComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/CookieComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/SecurityComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/SecurityComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/SecurityComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/PaginatorComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/PaginatorComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/PaginatorComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/BasicAuthenticateTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/BasicAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/BasicAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/FormAuthenticate.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/CrudAuthorizeTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/CrudAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/CrudAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/ActionsAuthorizeTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/ActionsAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/ActionsAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/ControllerAuthorizeTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/ControllerAuthorize', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/ControllerAuthorizeTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/Auth/DigestAuthenticateTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/Auth/DigestAuthenticate', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/Auth/DigestAuthenticateTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/AclComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/AclComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/AclComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/RequestHandlerComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/RequestHandlerComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/RequestHandlerComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/AuthComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/AuthComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/AuthComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/Component/EmailComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component/EmailComponent', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/Component/EmailComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/ControllerMergeVarsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/ControllerMergeVars', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ControllerMergeVarsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/ScaffoldTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Scaffold', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ScaffoldTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/ControllerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Controller', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/PagesControllerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/PagesController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/PagesControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/ComponentCollectionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/ComponentCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ComponentCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Controller/ComponentTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Controller/Component', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Controller/ComponentTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllConsoleTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllConsole', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllConsoleTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllCoreTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllCore', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllCoreTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/ConsoleErrorHandlerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleErrorHandler', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleErrorHandlerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/ConsoleOptionParserTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleOptionParser', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleOptionParserTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/AllConsoleLibsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/AllConsoleLibs', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/AllConsoleLibsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/ShellDispatcherTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ShellDispatcher', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ShellDispatcherTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/AllConsoleTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/AllConsole', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/AllConsoleTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/TaskCollectionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/TaskCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/TaskCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/ShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Shell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/ShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/TestsuiteShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/TestsuiteShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/TestsuiteShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/ApiShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/ApiShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/ApiShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/ModelTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ModelTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ModelTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/TestTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/TestTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/TestTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/TemplateTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/TemplateTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/TemplateTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/ProjectTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ProjectTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ProjectTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/ViewTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ViewTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ViewTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/ControllerTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ControllerTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ControllerTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/PluginTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/PluginTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/PluginTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/FixtureTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/FixtureTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/FixtureTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/DbConfigTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/DbConfigTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/DbConfigTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/Task/ExtractTaskTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/Task/ExtractTask', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/Task/ExtractTaskTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/CommandListShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/CommandListShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/CommandListShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/BakeShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/BakeShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/BakeShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/AclShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/AclShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/AclShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/Command/SchemaShellTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/Command/SchemaShell', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/Command/SchemaShellTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/HelpFormatterTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/HelpFormatter', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/HelpFormatterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/AllShellsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/AllShells', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/AllShellsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/ConsoleOutputTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/ConsoleOutput', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/ConsoleOutputTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Console/AllTasksTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Console/AllTasks', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Console/AllTasksTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Routing/Route/RedirectRouteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/RedirectRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/RedirectRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Routing/Route/PluginShortRouteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/PluginShortRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/PluginShortRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Routing/Route/CakeRouteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Route/CakeRoute', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/Route/CakeRouteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Routing/DispatcherTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Dispatcher', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/DispatcherTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Routing/RouterTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Routing/Router', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Routing/RouterTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelValidationTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelValidation', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelValidationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelTestBase.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/models.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ConnectionManagerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ConnectionManager', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ConnectionManagerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelReadTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelRead', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelReadTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelIntegrationTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelIntegration', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelIntegrationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelWriteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelWrite', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelWriteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/BehaviorCollectionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/BehaviorCollection', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/BehaviorCollectionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/DbAclTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/DbAcl', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/DbAclTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/CakeSchemaTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/CakeSchema', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/CakeSchemaTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Behavior/AclBehaviorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/AclBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/AclBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Behavior/TreeBehaviorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/TreeBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/TreeBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Behavior/ContainableBehaviorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/ContainableBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/ContainableBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Behavior/TranslateBehaviorTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Behavior/TranslateBehavior', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Behavior/TranslateBehaviorTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Session/CacheSessionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Session/CacheSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Session/CacheSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Session/DatabaseSessionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Session/DatabaseSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Session/DatabaseSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/DboSourceTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/DboSource', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/DboSourceTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Database/SqliteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Sqlite', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/SqliteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Database/MssqlTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Mssql', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/MssqlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Database/OrcaleTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Orcale', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/OrcaleTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Database/PostgresTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Postgres', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/PostgresTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/Database/MysqlTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/Database/Mysql', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/Database/MysqlTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/Datasource/CakeSessionTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/Datasource/CakeSession', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/Datasource/CakeSessionTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Model/ModelDeleteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Model/ModelDelete', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Model/ModelDeleteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllI18nTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllI18n', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllI18nTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllModelTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllModel', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllModelTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllUtilityTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllUtility', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllUtilityTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllControllerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllController', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllControllerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllDatabaseTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllDatabase', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllDatabaseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/CakeRequestTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeRequest', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeRequestTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Http/DigestAuthenticationTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/DigestAuthentication', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/DigestAuthenticationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Http/HttpResponseTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/HttpResponse', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/HttpResponseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Http/BasicAuthenticationTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/BasicAuthentication', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/BasicAuthenticationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Http/HttpSocketTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/HttpSocket', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/HttpSocketTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/CakeSocketTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeSocket', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeSocketTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/CakeResponseTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeResponse', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeResponseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Email/SmtpTransportTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/SmtpTransport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/SmtpTransportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Network/Email/CakeEmailTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/CakeEmail', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/CakeEmailTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Error/ErrorHandlerTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Error/ErrorHandler', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Error/ErrorHandlerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Error/ExceptionRendererTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Error/ExceptionRenderer', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Error/ExceptionRendererTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllHelpersTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllHelpers', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllHelpersTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllBehaviorsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllBehaviors', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllBehaviorsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Log/Engine/FileLog.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('lib/Cake/Test/Case/Log/CakeLogTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Log/CakeLog', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Log/CakeLogTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllTestSuiteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllTestSuite', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllTestSuiteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/AllComponentsTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('AllComponents', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/AllComponentsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/I18n/L10nTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/L10n', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/L10nTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/I18n/MultibyteTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/Multibyte', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/MultibyteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Case/I18n/I18nTest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/I18n', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/I18nTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Test/Fixture/CacheTestModelFixture.php');
		$this->assertFalse($result['testFile']);

		$result = testCase('lib/Cake/Network/CakeRequest.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeRequest', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeRequestTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Http/DigestAuthentication.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/DigestAuthentication', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/DigestAuthenticationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Http/HttpSocket.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/HttpSocket', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/HttpSocketTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Http/HttpResponse.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/HttpResponse', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/HttpResponseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Http/BasicAuthentication.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Http/BasicAuthentication', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Http/BasicAuthenticationTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/CakeResponse.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeResponse', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeResponseTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/CakeSocket.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/CakeSocket', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/CakeSocketTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Email/MailTransport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/MailTransport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/MailTransportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Email/CakeEmail.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/CakeEmail', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/CakeEmailTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Email/SmtpTransport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/SmtpTransport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/SmtpTransportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Network/Email/AbstractTransport.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Network/Email/AbstractTransport', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Network/Email/AbstractTransportTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Error/ExceptionRenderer.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Error/ExceptionRenderer', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Error/ExceptionRendererTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Error/ErrorHandler.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Error/ErrorHandler', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Error/ErrorHandlerTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Error/exceptions.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Error/exceptions', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Error/exceptionsTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Log/CakeLogInterface.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Log/CakeLogInterface', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Log/CakeLogInterfaceTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Log/Engine/FileLog.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Log/Engine/FileLog', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Log/Engine/FileLogTest.php', $result['testFile']);

		$result = testCase('lib/Cake/Log/CakeLog.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('Log/CakeLog', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/Log/CakeLogTest.php', $result['testFile']);

		$result = testCase('lib/Cake/I18n/I18n.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/I18n', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/I18nTest.php', $result['testFile']);

		$result = testCase('lib/Cake/I18n/Multibyte.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/Multibyte', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/MultibyteTest.php', $result['testFile']);

		$result = testCase('lib/Cake/I18n/L10n.php');
		$this->assertEquals('core', $result['category']);
		$this->assertEquals('I18n/L10n', $result['case']);
		$this->assertEquals('lib/Cake/Test/Case/I18n/L10nTest.php', $result['testFile']);

	}
}
