!function(){!async function(){try{const t="/api/tasks?id="+s(),n=await fetch(t),o=await n.json();e=o.tasks,a()}catch(e){console.log(e)}}();let e=[],t=[];document.querySelector("#save-task").addEventListener("click",(function(){o()}));function n(n){const o=n.target.value;t=""!==o?e.filter(e=>e.completed===o):[],a(1)}function a(n=0){!function(){const e=document.querySelector("#list-tasks");for(;e.firstChild;)e.removeChild(e.firstChild)}(),function(){const t=e.filter(e=>"0"===e.completed),n=document.querySelector("#pending");0===t.length?n.disabled=!0:n.disabled=!1}(),function(){const t=e.filter(e=>"1"===e.completed),n=document.querySelector("#completed");0===t.length?n.disabled=!0:n.disabled=!1}();const d=t.length?t:e;if(0===d.length){const e=document.querySelector("#list-tasks"),t=document.createElement("LI");return t.textContent="No hay tareas",t.classList.add("empty-tasks"),void e.appendChild(t)}const i={0:"Pendiente",1:"Completa"};d.forEach(t=>{const n=document.createElement("LI");n.dataset.taskId=t.id,n.classList.add("task");const d=document.createElement("P");d.textContent=t.name,n.ondblclick=function(){o(!0,t)};const l=document.createElement("DIV");l.classList.add("options");const r=document.createElement("BUTTON");r.classList.add("condition-task"),r.classList.add(""+i[t.completed].toLowerCase()),r.textContent=i[t.completed],r.dataset.conditionTask=t.completed,r.onclick=function(){!function(e){const t="1"===e.completed?"0":"1";e.completed=t,c(e)}({...t})};const m=document.createElement("BUTTON");m.classList.add("delete-task"),m.dataset.taskId=t.id,m.textContent="Eliminar",m.onclick=function(){!function(t){Swal.fire({title:"¿Estas seguro que quieres  eliminar la tarea?",text:"Esto no se puede revertir!",icon:"warning",showCancelButton:!0,cancelButtonText:"Cancelar",confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Eliminar"}).then(n=>{n.isConfirmed&&(Swal.fire("Borrado!","Tu tarea ha sido eliminada","success"),async function(t){const{completed:n,id:o,name:c}=t,d=new FormData;d.append("id",o),d.append("name",c),d.append("completed",n),d.append("projectId",s());try{const n="http://localhost:3000/api/task/delete",o=await fetch(n,{method:"POST",body:d});(await o.json()).result&&(e=e.filter(e=>e.id!==t.id),a())}catch(e){console.log(e)}}(t))})}({...t})},l.appendChild(r),l.appendChild(m),n.appendChild(d),n.appendChild(l);document.querySelector("#list-tasks").appendChild(n)})}function o(t=!1,n={}){const o=document.createElement("DIV");o.classList.add("modal"),o.innerHTML=`\n        <form class="form new-task">\n        <legend>${t?"Editar Tarea":"Añade una nueva tarea"}</legend>\n        <div class="field">\n            <label>Tarea</label>\n            <input type="text" name="task" placeholder="${t?"Edita la tarea":"Añadir Tarea al proyecto Actual"}" id="task" value="${n.name?n.name:""}">\n        </div>\n        <div class="options">\n            <input type="submit" class="submit-new-task" value="${t?"Editar Tarea":"Añadir Tarea"}">\n            <button type="button" class="close-modal">Cancelar</button>\n        </div>\n    </form>\n        `,setTimeout(()=>{document.querySelector(".form").classList.add("animate")},0),o.addEventListener("click",(function(d){if(d.target.classList.contains("close-modal")){document.querySelector(".form").classList.add("close"),setTimeout(()=>{o.remove()},400)}if(d.target.classList.contains("submit-new-task")){d.preventDefault();const o=document.querySelector("#task").value.trim();if(""===o)return void function(e,t,n){const a=document.querySelector(".alert");a&&a.remove();const o=document.createElement("DIV");o.classList.add("alert",t),o.textContent=e,n.parentElement.insertBefore(o,n.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}("El Nombre de la tarea es Obligatorio","error",document.querySelector(".form  legend"));t?(n.name=o,c(n)):async function(t){const n=new FormData;n.append("name",t),n.append("projectId",s());try{const o="http://localhost:3000/api/task",c=await fetch(o,{method:"POST",body:n}),s=await c.json();if("success"===s.type){Swal.fire(s.message,s.message,"success");document.querySelector(".modal").remove();const n={id:String(s.id),name:t,completed:"0",projectId:s.projectId};e=[...e,n],a()}}catch(e){console.log(e)}}(o)}})),document.querySelector(".dashboard").appendChild(o)}async function c(t){const{completed:n,id:o,name:c,projectId:d}=t,i=new FormData;i.append("id",o),i.append("name",c),i.append("completed",n),i.append("projectId",s());try{const t="http://localhost:3000/api/task/update",s=await fetch(t,{method:"POST",body:i}),d=await s.json();if("success"===d.answer.type){Swal.fire(d.answer.message,d.answer.message,"success");const t=document.querySelector(".modal");t&&t.remove(),e=e.map(e=>(e.id===o&&(e.completed=n,e.name=c),e)),a()}}catch(e){console.log(e)}}function s(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelectorAll('#filter input[type="radio"]').forEach(e=>{e.addEventListener("input",n)})}();