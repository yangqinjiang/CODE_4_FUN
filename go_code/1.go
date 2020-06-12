package main
import "fmt"
const (
	limit = 10000000000
)
func Sum() int{
	sum:=0
	for i:=0;i<limit;i++{
		sum=sum+i
	}
	return sum
}

func main(){
	fmt.Println("简单循环计算,结果为：",Sum())
}