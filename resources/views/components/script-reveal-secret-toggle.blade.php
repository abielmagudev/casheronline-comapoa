<script>const secretViewer={elements:document.querySelectorAll(".revelador"),listen:function(){this.elements.forEach(function(e){let t=document.getElementById(e.dataset.secreto);["mousedown","touchstart"].forEach(function(n){e.addEventListener(n,function(e){t.type="text"})}),["mouseup","touchend"].forEach(function(n){e.addEventListener(n,function(e){t.type="password"})})})}};secretViewer.listen();</script>
<?php /*
<script>

// Boton disparador debe tener la clase .revelador y el data-secreto del input:password que desea revelar(cambiar type)

const secretViewer = {
	elements: document.querySelectorAll('.revelador'),
	listen: function () {
		this.elements.forEach(function (element) {
            let secret_element = document.getElementById( element.dataset.secreto );

			['mousedown','touchstart'].forEach( function (evento) {	
				element.addEventListener(evento, function (e) {
					secret_element.type = 'text'
				})
			});
			
			['mouseup','touchend'].forEach( function (evento) {	
				element.addEventListener(evento, function (e) {
					secret_element.type = 'password'
				})
			});
		})
	}
}
secretViewer.listen()
</script>
*/ ?>
