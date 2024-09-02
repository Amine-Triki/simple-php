<script src="https://unpkg.com/typed.js@2.0.132/dist/typed.umd.js"></script>
<div class="autotyping">And I'm a <span class="typing_text"></span></div>
<script>
//typing text animation script
var typed = new Typed(".typing_text", {
strings: ["YouTuber", "Developer", "Blogger", "Freelancer"],
typeSpeed: 100,
backSpeed: 60,
loop: true,
cursorChar: '|️',
});
</script>
<style>
.autotyping{
font-family: 'Playfair Display', serif;
color: #000;
font-size:2.5em;
font-weight: 800;
}
.autotyping>span{
color: #991B1B;
font-size:1.2em;
font-weight: 700;
}
/*Shrinking for tablet*/
@media (min-width: 481px) and (max-width: 768px) {
.autotyping{
font-size:2.0em;
font-weight: 800;
}
.autotyping>span{
font-size:1.2em;
font-weight: 700;
}
}
/*Shrinking for mobile*/
@media (max-width: 480px) {
.autotyping{
font-size:1.9em;
font-weight: 800;
text-align: center;
}
.autotyping>span{
font-size:1.1em;
font-weight: 700;
}
}
</style>