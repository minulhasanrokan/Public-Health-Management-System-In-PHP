<?php
	include_once __DIR__."/../config/config.php";
	class Session{
		
		public static function initSession(){
			
			session_start();
		}

		public static function setSession($key, $value){
			
			$_SESSION[$key] = $value;
		}

		public static function getSession($key){
			
			if (isset($_SESSION[$key])) {
				
				return $_SESSION[$key];
			}
			else{
				return false;
			}
		}

		public static function loginCheck(){

			self::initSession();

			if (self::getSession('login')==true) {

				$path = BASEPATH;

				if (self::getSession('userStatus')==true) {
					header('location:'.$path.'user');
				}
				elseif(self::getSession('administratorStatus')==true) {
					header('location:'.$path.'admin');
				}
				elseif(self::getSession('doctorStatus')==true) {
					header('location:'.$path.'doctor');
				}
				elseif(self::getSession('hospitalStatus')==true) {
					header('location:'.$path.'hospital');
				}
			}
		}

		public static function checkSession(){

			self::initSession();

			if (self::getSession('login')==false) {
				self::destroySession();
			}
		}

		public static function checkSessionLogin(){

			$path = BASEPATH;

			if (self::getSession('userStatus')==true) {
				header('location:'.$path.'user');
			}
			elseif(self::getSession('administratorStatus')==true) {
				header('location:'.$path.'admin');
			}
			elseif(self::getSession('doctorStatus')==true) {
				header('location:'.$path.'doctor');
			}
			elseif(self::getSession('hospitalStatus')==true) {
				header('location:'.$path.'hospital');
			}
		}

		public static function destroySession(){

			session_destroy();
			$path = BASEPATH;

			header('location: '.$path);
		}
	}