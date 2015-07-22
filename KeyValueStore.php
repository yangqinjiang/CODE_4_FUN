<?php
/**
 * \责任链模式，其目的是组织一个对象链处理一个如方法调用的请求。
 * 
 * 最著名的责任链示例：多级缓存。
 * client提交给 hander，hander发现责任链上能处理该任务的函数，处理；
 * 可以归纳为：用一系列类(classes)试图处理一个请求request,这些类之间是一个松散的耦合,
 * 唯一共同点是在他们之间传递request. 也就是说，来了一个请求，A类先处理，如果没有处理，
 * 就传递到B类处理，如果没有处理，就传递到C类处理，就这样象一个链条(chain)一样传递下去。
 */

/**
* The Handler abstraction. Objects that want to be a part of the
* ChainOfResponsibility must implement this interface directly or via
* inheritance from an AbstractHandler.
* 处理抽象类，对象如果想成为责任链的一部分必须直接实现这个接口或
* 继承一个抽象的处理类
*/
interface KeyValueStore{
 /**
 * Obtain a value.
 * @param string $key
 * @return mixed
 */
    public function get($key);
}
/**
* Basic no-op implementation which ConcreteHandlers not interested in
* caching or in interfering with the retrieval inherit from.
* 接收一个请求，设法满足它，如果不成功就委派给下一个处理程序。
*/
abstract class AbstractKeyValueStore implements KeyValueStore{
     protected $_nextHandler;
     public function get($key){
        return $this->_nextHandler->get($key);
     }
}
/**
* Ideally the last ConcreteHandler in the chain. At least, if inserted in
* a Chain it will be the last node to be called.
* 理想情况下，责任链上最后的具体处理类，加入链上，将是最后被调用的节点。
*/
class SlowStore implements KeyValueStore{
 /**
 * This could be a somewhat slow store: a database or a flat file.
 */
     protected $_values;
     public function __construct(array $values = array()){
        $this->_values = $values;
     }
     public function get($key){
        return $this->_values[$key];
     }
}
/**
* A ConcreteHandler that handles the request for a key by looking for it in
* its own cache. Forwards to the next handler in case of cache miss.
* 在缓存没命中的情况下，转发到下一个处理对象
*/
class InMemoryKeyValueStore implements KeyValueStore{
     protected $_nextHandler;
     protected $_cached = array();
     public function __construct(KeyValueStore $nextHandler){
        $this->_nextHandler = $nextHandler;
     }
     protected function _load($key){
        if (!isset($this->_cached[$key])) {
            $this->_cached[$key] = $this->_nextHandler->get($key);
        }
     }
     public function get($key){
        $this->_load($key);
        return $this->_cached[$key];
     }
}
/**
* A ConcreteHandler that delegates the request without trying to
* understand it at all. It may be easier to use in the user interface
* because it can specialize itself by defining methods that generates
* html, or by addressing similar user interface concerns.
* Some Clients see this object only as an instance of KeyValueStore
* and do not care how it satisfy their requests, while other ones
* may use it in its entirety (similar to a class-based adapter).
* No client knows that a chain of Handlers exists.
* 不用关心调用的具体实现的外部具体具体处理程序；背后是责任链。
*/
class FrontEnd extends AbstractKeyValueStore{
    public function __construct(KeyValueStore $nextHandler){
        $this->_nextHandler = $nextHandler;
    }
    public function getEscaped($key){
        return htmlentities($this->get($key), ENT_NOQUOTES, 'UTF-8');
    }
}
// Client code
$store = new SlowStore(
    array(
        'pd' => 'Philip K. Dick',
        'ia' => 'Isaac Asimov',
        'ac' => 'Arthur C. Clarke',
        'hh' => 'Helmut Hei.enbttel'
    )
);
// in development, we skip cache and pass $store directly to FrontEnd
$cache    = new InMemoryKeyValueStore($store);
$frontEnd = new FrontEnd($cache);
echo $frontEnd->get('ia'). "\n";
echo $frontEnd->getEscaped('hh'). "\n";

/**
 * expect: ...
 * Isaac Asimov
 * Helmut Hei.enbttel
 * 
 * 参与者：
*Client（客户端）：向Handler（处理程序）提交一个请求；
*Handler（处理程序）抽象：接收一个请求，以某种方式满足它；
*ConcreteHandlers（具体的处理程序）：接收一个请求，设法满足它，如果不成功就委派给下一个处理程序。
 */
 ?>