# ikcrm
爱客CRM开发组件


安装组件:

	composer require firstphp/ikcrm



发布配置:

    php bin/hyperf.php vendor:publish firstphp/ikcrm



编辑.env配置：

	IKCRM_URL=https://dingtalk.e.ikcrm.com/
	IKCRM_USERNAME=150xxxxxxxx
	IKCRM_PASSWORD=123456



示例代码：

    use Firstphp\Ikcrm\IkcrmInterface;

    ......

    /**
     * @Inject
     * @var IkcrmInterface
     */
    protected $ikcrmInterface;

    public function test() {
        $res = $this->ikcrmInterface->userInfo();
        var_dump($res);
    }
