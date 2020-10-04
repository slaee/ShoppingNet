<?php
session_start();
// Empty Session 
if(empty($_SESSION['email'])) {
header("Location: ../?ref=logo");
}else {
$abc_logged = '
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" ><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 208.955 208.955" style="enable-background:new 0 0 208.955 208.955;fill:white;width:23px;" xml:space="preserve">
		<path d="M190.85,200.227L178.135,58.626c-0.347-3.867-3.588-6.829-7.47-6.829h-26.221V39.971c0-22.04-17.93-39.971-39.969-39.971
		C82.437,0,64.509,17.931,64.509,39.971v11.826H38.27c-3.882,0-7.123,2.962-7.47,6.829L18.035,200.784
		c-0.188,2.098,0.514,4.177,1.935,5.731s3.43,2.439,5.535,2.439h157.926c0.006,0,0.014,0,0.02,0c4.143,0,7.5-3.358,7.5-7.5
		C190.95,201.037,190.916,200.626,190.85,200.227z M79.509,39.971c0-13.769,11.2-24.971,24.967-24.971
		c13.768,0,24.969,11.202,24.969,24.971v11.826H79.509V39.971z M33.709,193.955L45.127,66.797h19.382v13.412
		c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5V66.797h49.936v13.412c0,4.142,3.357,7.5,7.5,7.5c4.143,0,7.5-3.358,7.5-7.5
		V66.797h19.364l11.418,127.158H33.709z"/>
		<g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
		</a>
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" >
		<?xml version="1.0" encoding="UTF-8"?>
		<svg style="width:23px;fill:white" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
		<path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z"/>
		<path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z"/>
		</svg>	
		</a>
		
		<a href="" class="black-text right" style="margin-right:20px;margin-top:5px" >
		<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 241.061 241.061" style="enable-background:new 0 0 241.061 241.061;width:23px;fill:white" xml:space="preserve">
		<g>
		<path d="M198.602,70.402l-78.063,68.789l-78.08-68.79c-3.109-2.739-7.848-2.438-10.586,0.669c-2.737,3.108-2.439,7.847,0.67,10.586
		l83.039,73.159c1.417,1.248,3.188,1.872,4.958,1.872s3.542-0.624,4.959-1.873l83.022-73.159c3.107-2.738,3.406-7.478,0.668-10.586
		C206.449,67.964,201.711,67.664,198.602,70.402z"/>
		<path d="M218.561,38.529H22.5c-12.406,0-22.5,10.093-22.5,22.5v119.002c0,12.407,10.094,22.5,22.5,22.5h196.061
		c12.406,0,22.5-10.093,22.5-22.5V61.029C241.061,48.623,230.967,38.529,218.561,38.529z M226.061,180.031
		c0,4.135-3.364,7.5-7.5,7.5H22.5c-4.136,0-7.5-3.365-7.5-7.5V61.029c0-4.135,3.364-7.5,7.5-7.5h196.061c4.136,0,7.5,3.365,7.5,7.5
		V180.031z"/>
		</g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a>';
}
require 'database/database_lvl3.php';
$query = mysqli_query($con, "SELECT * FROM `user_info` WHERE `email`='$_SESSION[email]'") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);

if(empty($fetch['global_profile'])) {
$profile_default = '<div id="container" class="red lighten-2" >
	<div id="name" class="name" >	
	</div>
</div>';

}else {
$profile_change = '<div class="profile_nav_user" >
	<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEABQODxIPDRQSEBIXFRQYHjIhHhwcHj0sLiQySUBMS0dARkVQWnNiUFVtVkVGZIhlbXd7gYKBTmCNl4x9lnN+gXwBFRcXHhoeOyEhO3xTRlN8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fP/AABEIAJAAbAMBIgACEQEDEQH/xAAaAAABBQEAAAAAAAAAAAAAAAAAAQIDBAUG/8QALxAAAgEDAwIFAgUFAAAAAAAAAAECAwQREiExBUETIlFhcYGRFSMyscEUM0Jiof/EABgBAQEBAQEAAAAAAAAAAAAAAAABAgME/8QAHREBAQEBAQACAwAAAAAAAAAAAAECESESMQNBUf/aAAwDAQACEQMRAD8A5cAAoAACAARyS7kbqN8bICUMr1Id2Lh5w9gJQGxyvdDgAAAAAAAUQAKAZOeNkOk8ES3ZAqi5MkVF+jJ7Wi5Y9exo07WKW+/0Ja1J1keCw0SXujc/o4VOwfhks7NNe5PkvwYiTT9ySK1PQ+UjRqdLqJbR+CP8OrRbk442wOnxrLy1LDHEtzT0Np7NEUf0o0xQAAAogoFEc+GNh+ofNDaS8yINayhiOS/TjkrWq/LTLlHCRzrtmLFGmiyqeCCm8cFhS24I0XRkjqUtiTUJKW24GD1a1Thrxn4Mc6bqCUqMvg5prDa9zeHLc9IAAaYKAAUNl2FjCVOeJxcXzuix0+KnfU1LhZf/AA1ryjCVq24+ZLKZm1qZ7OobXPgxLMacp5zPSQ2ixCC9i86Kqx074fODFrrJ4raKlPejXi36NF60r1X5a6Wrs0Qw6fQpvKjv7rIsnplGEMvHdikXK1ZUIOTWfYox6hUqvai9PwW6sdeE2uNslR2dbW3Gq0vkQqG6ra6E8rDS4Ofby8nS3NKUrfRUfmezaOfuqSoXE6a4i9jWGN9RCABtzKAAA+1n4d3Tl/tj77HSXFSEraaaxlc+2DlpI17a+hVtZU6jfi6XnC5Majpi/o6zllx+DWpboxbF+bk2KeUjFbz9J3DbnBSbzNuOcZ+5LUrxisZKsZOTbUWlkNNDfTGTJt8GbK5mnGM5OUI+hcp1tXfYgjuvMoxWzbSOb6hPxL6vL1k19tjduKyjU1viGZP6I5ttybk+XuzeHP8AJSCCgdHIAAABJZb3KS7pkbJLOSjcxzt6EpPtatJ6Kq+Tbi3ODw8ZMa6pOnUc47RluWLW78uJGLOusvFiopKSljMX37ot0fBlt48ot9nFDKUlXpprnHcV/lreO3sZb8pLqVOmpeFU8WS/x0hQTW7WNnlDqcVPdR/ghuLhUpS4xjA+1vin1JSlSk48QWZfUxzfucx6JUnNYlUe2fTsYB1zOR59XtAABUAcC4BYyAkU28sbJYkTIZUW3wBrWNeF5RdGr/cS+/uVq1CdvN86c8opQk4yUotqS3TRsWt7C5Sp3GFU4Uu0jFnG5e+VDb3Tg1FvY0qN1QlHOrfPBVrdNjPLptx9itKwuovy5f1J417Gjc3dOm803yZ8Luk7yMrhvwk84W+X7jqPTqjqJVpbd0jPuXF3NTQsRUmkkXMiat4v9X6nG8006OfDju2+5lgBtzAAADsCND8BjkqEixXugQ4CJLDwOQsltkEBoWXUXSxTr5lDhS7o2Y1IygnFpp7po5dli2vKltGSitUH29GY1l0zv+tO8uVb0Jzz55bROfJa1aVaeuby/wBiNrMcrsWTia12kAWOHsxXForJoAIBMJuh4i5aKhqHIVpCgI1lYIyUiaxJ+jAHJInpYnTa2TRXaH2r01d2vqSrEWfM0Ojy16iTXmfyC9QBrSx0ZdmLJakR4a5Kh7WRjRJHjcXBB//Z" class="profile_nav" alt="Profile Img" >
</div>';

}
?>

<?php
include("database/database_lvl3.php");
define("MAX_SIZE", "10000");
if(isset($_POST['but_upload'])){
  $email = $_SESSION['email'];
  $temp = explode(".", $_FILES["file"]["name"]);
  $name = round(microtime(true)) . '.' . end($temp);
  $target_dir = "static/cdn/profile_5_82_9181_17/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  
  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     $result = mysqli_query($con, "UPDATE user_info SET global_profile='$name' WHERE email='$email'");
     mysqli_query($con,$result);
  
     // Upload 
     move_uploaded_file($_FILES["file"]["tmp_name"], "static/cdn/profile_5_82_9181_17/" . $name);
     
     //move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

  } 
}
?>

<form method="post" action="" enctype='multipart/form-data'>
  <input type='file' name='file' />
  <input type='submit' value='Save name' name='but_upload'>
</form>