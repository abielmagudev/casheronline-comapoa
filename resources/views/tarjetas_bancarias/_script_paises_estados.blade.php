<script>const selectPais={element:document.getElementById("selectPais"),listen:function(){this.element.addEventListener("change",function(e){selectEstado.load(e.target.value)})}},selectEstado={element:document.getElementById("selectEstado"),clear:function(){this.element.firstElementChild.setAttribute("label","Ahora selecciona el estado..."),this.element.selectedIndex=0},load:function(e){this.clear(),this.element.querySelectorAll("optgroup").forEach(function(t){t.id=="optgroup"+e?(t.classList.remove("d-none"),t.classList.add("d-block")):(t.classList.remove("d-block"),t.classList.add("d-none"))})}};selectPais.listen();</script>

<?php
/*
<script>
const selectPais = {
    element: document.getElementById('selectPais'),
    listen: function () {
        this.element.addEventListener('change', function (e) {
            selectEstado.load(e.target.value)
        })
    }
}

const selectEstado = {
    element: document.getElementById('selectEstado'),
    clear: function () {
        this.element.firstElementChild.setAttribute('label', 'Ahora selecciona el estado...')
        this.element.selectedIndex = 0
    },
    load: function (show_group_id) {
        this.clear()
        this.element.querySelectorAll('optgroup').forEach( function (group) {
            if( group.id == ('optgroup' + show_group_id) )
            {
                group.classList.remove('d-none')
                group.classList.add('d-block')
            }
            else
            {
                group.classList.remove('d-block')
                group.classList.add('d-none')
            }
        })
    }
}

selectPais.listen()
</script>
*/
?>
