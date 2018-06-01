<?php 
	class Image{
		
		//Hàm thu nhỏ hình
		public static function thumb($link_img,$folder,$desired_width)
		{
			//lấy nguồn img
			$source_img = imagecreatefromjpeg($link_img);
			$width = imagesx($source_img);
			$height = imagesy($source_img);
			
			//Chiều cao muốn thu nhỏ of hình
			$desired_height = floor($height*($desired_width/$width));
			
			//Tạo hình mới
			$virtual_img = imagecreatetruecolor($desired_width,$desired_height);
			
			imagecopyresampled($virtual_img,$source_img,0,0,0,0,$desired_width,$desired_height,$width,$height);
			
			imagejpeg($virtual_img,$folder);
			
		}
		public static function GetFile($ten){	
			//print_r($_FILES["'".$ten."'"]); //In mảng 
			$dest="";
			if($ten["type"]=="image/jpeg" || $ten["type"]=="image/gif" || $ten["type"]=="image/png")
			{
				move_uploaded_file($ten["tmp_name"],"../Views/img/".$ten["name"]);
				$source="../Views/img/".$ten['name'];
				$img=$_FILES["upload"]["name"];
				$dest = "../Views/img/thumb/thumb_".$img; //Nguồn lưu ảnh nhỏ
				$clss= new Image();
				$clss->thumb($source,$dest,100);
			}
			return $dest;
		}
	}
?>