package main
import ("fmt")
func f1(in chan int){
	fmt.Println(<- in)
}
//阻塞
func c1(){
	out := make(chan int)
	out <- 2 //阻塞在这里,协程没办法执行下去
	//解决办法就两个，要么在out <- 2之前开一个goroutine去消费这个channel， 要么就给这个channel加个缓冲防止阻塞。
	go f1(out)
}
//解决方法1.先消费channel
func c2(){
	out := make(chan int)
	//调整下位置， 先消费
	go f1(out)
	out <- 2
}
//解决方法2.给channel加buffer
func c3(){
	out := make(chan int,1)//buffer大于0，给channel加buffer
	out <- 2
	go f1(out)
}
func main(){
	//c1()
	//c2()
	c3()

}