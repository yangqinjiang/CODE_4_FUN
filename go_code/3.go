//使用通道和goroutines并发计算
package main
import (
	"fmt"
	"runtime"
)
const (
	limit = 10000000000
)
func Sum() int{
	//使用GOMAXPROCS 获取可用的硬件线程总数。通常为物理CPU数量的两倍
	n := runtime.GOMAXPROCS(0)
	//下面我们用一个变量存储每个goroutine的中间计算结果，并通过一个通道将结果将结果传递到主程序中。也使用通道来控制goroutine并发：
	res := make(chan int)
		
	//chansum函数生使用n（硬件线程总数）个goroutines，使用一个中间变量保存这n个数的和，通过一个整型通道res传回结果。
	//当没有要读取的元素时，通道会自动阻塞。所以，我们无需做同步管理。
	for i:=0;i<n;i++{
		
		go func(i int, r chan<- int){
			sum := 0
			start := (limit / n) * i
			end := start + (limit /n)
			for j := start; j < end; j++ {
				sum += j
			}
			r <- sum
		}(i, res)

	}
	sum := 0
	for i:= 0 ; i<n;i++{
		sum += <-res
	}

	return sum
}

func main(){
	fmt.Println("使用通道和goroutines并发计算,结果为：",Sum())
}

//我们将切片转换为n个单独的变量，这样让他们彼此孤立分散在内存各处，不让他们共享一个缓存行即可