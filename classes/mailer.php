<?php
class mailer{
	private $receiver;
	private $subject;
	private $message;
	private $headers;
	private $parameters;
	private function getReceiver(){
		return $this->receiver;
		}
	public function setReceiver($r){
		$this->receiver = $r;
		}
	private function getSubject(){
		return $this->subject;
		}
	public function setSubject($s){
		$this->subject = $s;
		}
	private function getMessage(){
		return $this->message;
		}
	public function setMessage($m){
		$this->message = $m;
		}
	private function getHeaders(){
		return $this->headers;
		}
	public function setHeaders($h){
		$this->headers = $h;
		}
	private function getParameters(){
		return $this->parameters;
		}
	public function setParameters($p){
		$this->parameters = escapeshellcmd($p);
		}
	public function _msend(){
		if(!mail($this->getReceiver(),$this->getSubject(),$this->getMessage(),$this->getHeaders(),$this->getParameters())){
			return error_get_last();
			}else{
			$res = array("Status"=>"Success","Info"=>"E-mail Sent Successfully to :  {$this->getReceiver()}"); return $res;
			}
		}
	}
?>
