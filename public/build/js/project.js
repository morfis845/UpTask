!function(){const e=document.querySelectorAll(".edit"),t=document.querySelectorAll(".delete"),o=document.querySelectorAll(".project li")??"",n=document.querySelectorAll(".project");for(let t=0;t<e.length;t++)e[t].addEventListener("click",(function(){c(n[t].id,o[t].textContent)}));for(let e=0;e<t.length;e++)t[e].addEventListener("click",(function(){var t;t=n[e].id,Swal.fire({title:"¿Estas seguro que quieres  eliminar la tarea?",text:"Esto no se puede revertir!",icon:"warning",showCancelButton:!0,cancelButtonText:"Cancelar",confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Eliminar"}).then(e=>{if(e.isConfirmed){Swal.fire("Borrado!","Tu tarea ha sido eliminada","success"),async function(e){const t=new FormData;t.append("id",e);try{const e="api/project/delete",o=await fetch(e,{method:"POST",body:t});await o.json()}catch(e){console.log(e)}}(t);const e=document.querySelector(".swal2-confirm"),o=document.querySelector(".swal2-container");e.addEventListener("click",(function(){location.reload()})),o.addEventListener("click",(function(){location.reload()}))}})}));function c(e,t){console.log(parent);const o=document.createElement("DIV");o.classList.add("modal"),o.innerHTML=`\n            <form class="form edit-project">\n            <legend>Editar Proyecto</legend>\n            <div class="field">\n                <label>Tarea</label>\n                <input type="text" name="project" placeholder="Editar el Proyecto" id="project" value="${t.trim()}">\n            </div>\n            <div class="options">\n                <input type="hidden" id="${e}" class="id-project">\n                <input type="submit" class="submit-edit-project" value="Editar">\n                <button type="button" class="close-modal">Cancelar</button>\n            </div>\n        </form>\n            `,setTimeout(()=>{document.querySelector(".form").classList.add("animate")},0),o.addEventListener("click",(function(e){if(e.target.classList.contains("close-modal")){document.querySelector(".form").classList.add("close"),setTimeout(()=>{o.remove()},400)}if(e.target.classList.contains("submit-edit-project")){const e=document.querySelector(".id-project"),t=document.querySelector("#project").value.trim();if(""===t)return void function(e,t,o){const n=document.querySelector(".alert");n&&n.remove();const c=document.createElement("DIV");c.classList.add("alert",t),c.textContent=e,o.parentElement.insertBefore(c,o.nextElementSibling),setTimeout(()=>{c.remove()},5e3)}("El Nombre de la tarea es Obligatorio","error",document.querySelector(".form  legend"));!async function(e,t){const o=new FormData;o.append("id",e),o.append("project",t);try{const e="/api/project/update",t=await fetch(e,{method:"POST",body:o});await t.json()}catch(e){console.log(e)}}(e.id,t)}})),document.querySelector(".dashboard").appendChild(o)}}();