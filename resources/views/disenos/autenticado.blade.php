<x-navbar></x-navbar>
<div class='container'>
	<x-notification></x-notification>
	@yield('contenido')
</div>
<x-footer></x-footer>
<script>const terminarSesionTriggers={triggers:document.querySelectorAll(".terminar-sesion"),form:document.getElementById("formTerminarSesion"),listen:function(){let e=this;this.triggers.forEach(function(r){r.addEventListener("click",function(r){r.preventDefault(),e.form.submit()})})}};terminarSesionTriggers.listen();</script>

<?php
/*
<script>
const terminarSesionTriggers = {
	triggers: document.querySelectorAll('.terminar-sesion'),
	form: document.getElementById('formTerminarSesion'),
	listen: function () {
		let self = this
		this.triggers.forEach(function (trigger) {
			trigger.addEventListener('click', function (e) {
				e.preventDefault()
				self.form.submit()
			})
		})
	}
}
terminarSesionTriggers.listen()
</script>
*/
?>
