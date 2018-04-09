<?php $title = 'Games'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'Games'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include('includes/head.php'); ?>
</head>
<body>
	<?php include('includes/nav-bar.php'); ?>
	<div class="content">
		<h1>Games</h1>
		<br><br>

		<div class="slideshow-container">

		<a href=""><div class="mySlides fade">
		  <div class="numbertext">1 / 3</div>
		  <img src="images/img1.jpg" style="width:100%">
		  <div class="text">Mountain Game</div>
		</div></a>

		<div class="mySlides fade">
		  <div class="numbertext">2 / 3</div>
		  <img src="images/img2.jpg" style="width:100%">
		  <div class="text">Tree Game</div>
		</div>

		<div class="mySlides fade">
		  <div class="numbertext">3 / 3</div>
		  <img src="images/img3.jpg" style="width:100%">
		  <div class="text">River Game</div>
		</div>

		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		<a class="next" onclick="plusSlides(1)">&#10095;</a>

		</div>
		<br>

		<div style="text-align:center">
		  <span class="dot" onclick="currentSlide(1)"></span> 
		  <span class="dot" onclick="currentSlide(2)"></span> 
		  <span class="dot" onclick="currentSlide(3)"></span> 
		</div>

		<input type="text" id="myInput" onkeyup="search()" placeholder="Search for names.." title="Type in a name">

		 <table id="myTable">
		  <tr class="header">
		    <th>Name</th>
		    <th>Description</th> 
		    <th>Users</th>
		  </tr>
		  <tr>
		    <td>Mountain Game <a href=""><img src="images/img1.jpg" style="width:100%"></a></td>
		    <td>a game to explore mountains</td>
		    <td>50</td>
		  </tr>
		  <tr>
		    <td>Tree Game<a href=""><img src="images/img2.jpg" style="width:100%"></a></td>
		    <td>a game to explore trees</td>
		    <td>94</td>
		  </tr>
		  <tr>
		    <td>River Game<a href=""><img src="images/img3.jpg" style="width:100%"></a></td>
		    <td>a game to explore rivers</td>
		    <td>80</td>
		  </tr>
		</table>

		<?php include('includes/footer.php'); ?>
	</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}

function search() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>