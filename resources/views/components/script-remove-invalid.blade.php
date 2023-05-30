<script>const allInvalid={elements:document.querySelectorAll(".is-invalid"),events:["keydown","change"],listen:function(){let e=this;e.events.forEach(function(n){e.elements.forEach(function(e){e.addEventListener(n,function(){this.classList.remove("is-invalid")})})})}};allInvalid.listen();</script>

<?php
/*
<script>
const allInvalid = {
    elements: document.querySelectorAll('.is-invalid'),
    events: ['keydown', 'change'],
    listen: function () {
        let self = this

        self.events.forEach( function (event) {
            self.elements.forEach( function (element) {
                element.addEventListener(event, function () {
                    this.classList.remove('is-invalid')
                })
            })
        })
    }
}
allInvalid.listen()
</script>
*/
?>
