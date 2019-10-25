/*let navbar = document.getElementById("navbar");
let util_dropdown = document.getElementById("util-dropdown");
let ligneUne = document.getElementById("ligne1");
let ligneDeux = document.getElementById("ligne2");
let ligneTrois = document.getElementById("ligne3");

let sticky = navbar.offsetTop;

function collerNavbar()
{
	if (window.pageYOffset >= sticky) 
	{
		ligneUne.classList.add("whiteline");
		ligneUne.classList.remove("blackline");
		ligneDeux.classList.add("whiteline");
		ligneDeux.classList.remove("blackline");
		ligneTrois.classList.add("whiteline");
		ligneTrois.classList.remove("blackline");
		util_dropdown.classList.remove("noir");
		navbar.classList.add("sticky-top");
		navbar.classList.add("bg-green");
		navbar.classList.remove("bg-grey");
	} 
	else 
	{
		ligneUne.classList.remove("whiteline");
		ligneUne.classList.add("blackline");
		ligneDeux.classList.remove("whiteline");
		ligneDeux.classList.add("blackline");
		ligneTrois.classList.remove("whiteline");
		ligneTrois.classList.add("blackline");
		util_dropdown.classList.add("noir");
		navbar.classList.remove("sticky-top");
		navbar.classList.remove("bg-green");
		navbar.classList.add("bg-grey");
	}
} 

window.addEventListener("scroll",collerNavbar);*/

$(document).ready(function() {
	$(window).scroll(function() {
		var sticky = $("#navbar").offset();
		var windowOff = $(window).scrollTop();
		if (windowOff >= sticky.top)
			{
				$("#utildropdown").removeClass("noir").addClass("blanc");	
				$("[id^='ligne']").removeClass("blackline").addClass("whiteline");
				$("#navbar").removeClass("bg-grey").addClass("bg-green sticky-top");
			}
		else
			{
				$("#utildropdown").addClass("noir").removeClass("blanc");
				$("[id^='ligne']").removeClass("whiteline").addClass("blackline");
				$("#navbar").addClass("bg-grey").removeClass("bg-green sticky-top");
			}
	})
});