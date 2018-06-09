# tp5

ThinkPHP5.0的助手函数汇总 	 

load_trait：快速导入Traits，PHP5.5以上无需调用
/**
 * 快速导入Traits PHP5.5以上无需调用
 * @param string    $class trait库
 * @param string    $ext 类库后缀
 * @return boolean
 */
load_trait($class, $ext = EXT)
复制代码
exception：抛出异常处理
/**
 * 抛出异常处理
 * @param string    $msg  异常消息
 * @param integer   $code 异常代码 默认为0
 * @param string    $exception 异常类
 *
 * @throws Exception
 */
exception($msg, $code = 0, $exception = '')
复制代码
debug：记录时间（微秒）和内存使用情况
/**
 * 记录时间（微秒）和内存使用情况
 * @param string            $start 开始标签
 * @param string            $end 结束标签
 * @param integer|string    $dec 小数位 如果是m 表示统计内存占用
 * @return mixed
 */
debug($start, $end = '', $dec = 6)
复制代码
lang：获取语言变量值
/**
 * 获取语言变量值
 * @param string    $name 语言变量名
 * @param array     $vars 动态变量值
 * @param string    $lang 语言
 * @return mixed
 */
lang($name, $vars = [], $lang = '')
复制代码
config：获取和设置配置参数
/**
 * 获取和设置配置参数
 * @param string|array  $name 参数名
 * @param mixed         $value 参数值
 * @param string        $range 作用域
 * @return mixed
 */
config($name = '', $value = null, $range = '')
复制代码
input：获取输入数据，支持默认值和过滤
/**
 * 获取输入数据 支持默认值和过滤
 * @param string    $key 获取的变量名
 * @param mixed     $default 默认值
 * @param string    $filter 过滤方法
 * @return mixed
 */
input($key = '', $default = null, $filter = null)
复制代码
widget：渲染输出Widget
/**
 * 渲染输出Widget
 * @param string    $name Widget名称
 * @param array     $data 传入的参数
 * @return mixed
 */
widget($name, $data = [])
复制代码
model：实例化Model
/**
 * 实例化Model
 * @param string    $name Model名称
 * @param string    $layer 业务层名称
 * @param bool      $appendSuffix 是否添加类名后缀
 * @return \think\Model
 */
model($name = '', $layer = 'model', $appendSuffix = false)
复制代码
validate：实例化验证器
/**
 * 实例化验证器
 * @param string    $name 验证器名称
 * @param string    $layer 业务层名称
 * @param bool      $appendSuffix 是否添加类名后缀
 * @return \think\Validate
 */
validate($name = '', $layer = 'validate', $appendSuffix = false)
复制代码
db：实例化数据库类
/**
 * 实例化数据库类
 * @param string        $name 操作的数据表名称（不含前缀）
 * @param array|string  $config 数据库配置参数
 * @param bool          $force 是否强制重新连接
 * @return \think\db\Query
 */
db($name = '', $config = [], $force = true)
复制代码
controller：实例化控制器，格式：[模块/]控制器
/**
 * 实例化控制器 格式：[模块/]控制器
 * @param string    $name 资源地址
 * @param string    $layer 控制层名称
 * @param bool      $appendSuffix 是否添加类名后缀
 * @return \think\Controller
 */
controller($name, $layer = 'controller', $appendSuffix = false)
复制代码
action：调用模块的操作方法，参数格式：[模块/控制器/]操作
/**
 * 调用模块的操作方法 参数格式 [模块/控制器/]操作
 * @param string        $url 调用地址
 * @param string|array  $vars 调用参数 支持字符串和数组
 * @param string        $layer 要调用的控制层名称
 * @param bool          $appendSuffix 是否添加类名后缀
 * @return mixed
 */
action($url, $vars = [], $layer = 'controller', $appendSuffix = false)
复制代码
import：导入所需的类库，同java的Import，本函数有缓存功能
/**
 * 导入所需的类库 同java的Import 本函数有缓存功能
 * @param string    $class 类库命名空间字符串
 * @param string    $baseUrl 起始路径
 * @param string    $ext 导入的文件扩展名
 * @return boolean
 */
 import($class, $baseUrl = '', $ext = EXT)
复制代码
vendor：快速导入第三方框架类库，所有第三方框架的类库文件统一放到系统的Vendor目录下面
/**
 * 快速导入第三方框架类库 所有第三方框架的类库文件统一放到 系统的Vendor目录下面
 * @param string    $class 类库
 * @param string    $ext 类库后缀
 * @return boolean
 */
vendor($class, $ext = EXT)
复制代码
dump：浏览器友好的变量输出
/**
 * 浏览器友好的变量输出
 * @param mixed     $var 变量
 * @param boolean   $echo 是否输出 默认为true 如果为false 则返回输出字符串
 * @param string    $label 标签 默认为空
 * @return void|string
 */
dump($var, $echo = true, $label = null)
复制代码
url：Url生成
/**
 * Url生成
 * @param string        $url 路由地址
 * @param string|array  $vars 变量
 * @param bool|string   $suffix 生成的URL后缀
 * @param bool|string   $domain 域名
 * @return string
 */
url($url = '', $vars = '', $suffix = true, $domain = false)
复制代码
session：Session管理
/**
 * Session管理
 * @param string|array  $name session名称，如果为数组表示进行session设置
 * @param mixed         $value session值
 * @param string        $prefix 前缀
 * @return mixed
 */
session($name, $value = '', $prefix = null)
复制代码
cookie：Cookie管理
/**
 * Cookie管理
 * @param string|array  $name cookie名称，如果为数组表示进行cookie设置
 * @param mixed         $value cookie值
 * @param mixed         $option 参数
 * @return mixed
 */
cookie($name, $value = '', $option = null)
复制代码
cache：缓存管理
/**
 * 缓存管理
 * @param mixed     $name 缓存名称，如果为数组表示进行缓存设置
 * @param mixed     $value 缓存值
 * @param mixed     $options 缓存参数
 * @param string    $tag 缓存标签
 * @return mixed
 */
cache($name, $value = '', $options = null, $tag = null)
复制代码
trace：记录日志信息
/**
 * 记录日志信息
 * @param mixed     $log log信息 支持字符串和数组
 * @param string    $level 日志级别
 * @return void|array
 */
trace($log = '[think]', $level = 'log')
复制代码
request：获取当前Request对象实例
/**
 * 获取当前Request对象实例
 * @return Request
 */
request()
复制代码
response：创建普通Response对象实例
/**
 * 创建普通 Response 对象实例
 * @param mixed      $data   输出数据
 * @param int|string $code   状态码
 * @param array      $header 头信息
 * @param string     $type
 * @return Response
 */
response($data = [], $code = 200, $header = [], $type = 'html')
复制代码
view：渲染模板输出
/**
 * 渲染模板输出
 * @param string    $template 模板文件
 * @param array     $vars 模板变量
 * @param array     $replace 模板替换
 * @param integer   $code 状态码
 * @return \think\response\View
 */
view($template = '', $vars = [], $replace = [], $code = 200)
复制代码
json：获取Json对象实例
/**
 * 获取\think\response\Json对象实例
 * @param mixed   $data 返回的数据
 * @param integer $code 状态码
 * @param array   $header 头部
 * @param array   $options 参数
 * @return \think\response\Json
 */
json($data = [], $code = 200, $header = [], $options = [])
复制代码
jsonp：获取Jsonp对象实例
/**
 * 获取\think\response\Jsonp对象实例
 * @param mixed   $data    返回的数据
 * @param integer $code    状态码
 * @param array   $header 头部
 * @param array   $options 参数
 * @return \think\response\Jsonp
 */
jsonp($data = [], $code = 200, $header = [], $options = [])
复制代码
xml：获取xml对象实例
/**
 * 获取\think\response\Xml对象实例
 * @param mixed   $data    返回的数据
 * @param integer $code    状态码
 * @param array   $header  头部
 * @param array   $options 参数
 * @return \think\response\Xml
 */
xml($data = [], $code = 200, $header = [], $options = [])
复制代码
redirect：获取Redirect对象实例
/**
 * 获取\think\response\Redirect对象实例
 * @param mixed         $url 重定向地址 支持Url::build方法的地址
 * @param array|integer $params 额外参数
 * @param integer       $code 状态码
 * @return \think\response\Redirect
 */
redirect($url = [], $params = [], $code = 302)
复制代码
abort：抛出HTTP异常
/**
 * 抛出HTTP异常
 * @param integer|Response      $code 状态码 或者 Response对象实例
 * @param string                $message 错误信息
 * @param array                 $header 参数
 */
abort($code, $message = null, $header = [])
复制代码
halt：调试变量并且中断输出
/**
 * 调试变量并且中断输出
 * @param mixed      $var 调试变量或者信息
 */
halt($var)
复制代码
token：生成表单令牌
/**
 * 生成表单令牌
 * @param string $name 令牌名称
 * @param mixed  $type 令牌生成方法
 * @return string
 */
token($name = '__token__', $type = 'md5')
