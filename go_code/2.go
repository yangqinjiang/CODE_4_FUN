package main
import (
	"fmt"
	"runtime"
	"sync"
)
const (
	limit = 10000000000
)
func Sum() int{
	//使用GOMAXPROCS 获取可用的硬件线程总数。通常为物理CPU数量的两倍
	n := runtime.GOMAXPROCS(0)
	sums := make([]int, n)
	wg := sync.WaitGroup{}

	for i:=0;i<n;i++{
		//用来增加或者减少goroutine的数量
		wg.Add(1)
		go func(i int){
			start := (limit / n) * i
			end := start + (limit /n)
			for j := start; j < end; j++ {
				sums[i] += j
			}
			wg.Done()
		}(i)

	}
	//Wait方法可以用来阻塞并检测 goroutine的完成
	wg.Wait()
	sum := 0
	for _,s := range sums{
		sum += s
	}

	return sum
}

func main(){
	fmt.Println("使用goroutines和slice并发计算,结果为：",Sum())
}

//对比简单循环计算的结果，不论是user用户态（多核）执行的时间，
//还是真正总时间都比简单循环的多。多核执行花费时间是单核的4倍（user态），基本上没有节省时间