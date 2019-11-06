<?php 

namespace App\Crawl;

class Element{
  public $value;
  public $next;
}

/**
  * Queue class that store element in queue
  * Remove element from front
  * Insert element to back
  */
class CrawlerQueue{
  private $front = null;
  private $back = null; 
  
  /**
    * Check whether the queue is empty or not
    * @return boolean
    */
  public function isEmpty(){
    return $this->front == null;
  }
  
  /** 
    * Insert element at the back of queue
    * @param $value
    * public function enqueue($value){} //stub
    */
  public function enqueue($value){
     $oldBack = $this->back;
     $this->back = new Element(); 
     $this->back->value = $value;
     if($this->isEmpty()){
       $this->front = $this->back; 
     }else{
       $oldBack->next = $this->back;
     }
  }
  
  /**
    * Remove element from the front of queue
    * @return $value
    * public function dequeue(){ return 0; } //stub
    */ 
  public function dequeue(){
    if($this->isEmpty()){
      return null; 
    }
    $removedValue = $this->front->value;
    $this->front = $this->front->next;
    return $removedValue;
  }
}