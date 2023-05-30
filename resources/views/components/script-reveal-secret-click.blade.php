<script>const secretViewer={elements:document.querySelectorAll(".revelador"),listen:function(){this.elements.forEach(function(e){let t=document.getElementById(e.dataset.secreto);e.addEventListener("click",function(){t.type="password"==t.type?"text":"password"})})}};secretViewer.listen();</script>
<?php /*
<script>

// Boton disparador debe tener la clase .revelador y el data-secreto del input:password que desea revelar(cambiar type)

const secretViewer = {
	elements: document.querySelectorAll('.revelador'),
	listen: function () {
		this.elements.forEach(function (element) {
            let secret_element = document.getElementById( element.dataset.secreto )

            element.addEventListener('click', function () {
                secret_element.type = secret_element.type == 'password' ? 'text' : 'password'
            })
		})
	}
}
secretViewer.listen()
</script>
*/ ?>
