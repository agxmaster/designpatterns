## php对象复制
### php对象是引用传递 直接用=复制出来的对象和复制前的对象是同一个对象
```php
<?php
class Student{
  private $studentNumber = '';
  public $teacher = null;

  public function __construct(){
     $this->studentNumber = rand(1000,9999);
     $this->teacher = new Teacher();
  }

  public function setStudentNumber($studentNumber){
      $this->studentNumber = $studentNumber;
  }

  public function getStudentNumber(){
      return $this->studentNumber;
  }
}

class Teacher{

    private $teacherId = '';
    public function __construct(){
      $this->teacherId = rand(1000,9999);
    }

    public function getTeacherId(){
      return $this->teacherId;
    }
}

//php类都是引用传递所以studenta和studentb是一个对象
$studenta = new student();
$studentb = $studenta;
$studentb->setStudentNumber('aaa');
echo $studentb->getStudentNumber();
echo "<br>";
echo $studenta->getStudentNumber();
```
### 用clone关键字实现复制
* clone出来的对象和原来对象是两个对象，但是对象里面引用的对象则没有被clone(浅复制)

```php
<?php
$studenta = new student();
$studentb = clone $studenta;
$studentb->setStudentNumber('aaa');
echo $studentb->getStudentNumber();
echo "<br>";
echo $studenta->getStudentNumber();
echo "<br>";
$studentb->teacher->setTeacherId('bbb');

echo $studenta->teacher->getTeacherId();
echo "<br>";
echo $studentb->teacher->getTeacherId();
```
### 引用对象的深复制

* Student类中添加__clone 方法 在clone操作时会被调用。

```php
<?php
public function __clone(){
    $this->teacher = new Teacher();
}

$studenta = new student();
$studentb = $studenta;
$studentb->setStudentNumber('aaa');
echo $studentb->getStudentNumber();
echo "<br>";
echo $studenta->getStudentNumber();
```
* 用serialize 和 unserialize 实现深复制

```php
<?php
$studenta = new student();
$studentb = unserialize(serialize($studenta));
$studentb->setStudentNumber('aaa');
echo $studentb->getStudentNumber();
echo "<br>";
echo $studenta->getStudentNumber();
echo "<br>";
$studentb->teacher->setTeacherId('bbb');

echo $studenta->teacher->getTeacherId();
echo "<br>";
echo $studentb->teacher->getTeacherId();
```
### 对象在serialize时执行__sleep可用于隐藏属性
* 每个学生都有自己的学号所以复制时不想给别人看。

```php
<?php
public function __sleep(){
   return ['teacher'];
}
```
### 在对象unserialize时执行__wakeup设置自己的独特的属性值
* 给每个人安排一个学号。

```php  
<?php
public function __wakeup(){
     $this->studentNumber = '00000';
}
```

# 原型模式

* 原型模式用于创建复杂的对象，可以节省开支，省去一些属性的赋值。
