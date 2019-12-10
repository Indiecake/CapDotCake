new Vue({
			el:'#main',
			data:{
				people:['tu','yo','hanna','tio']
			},
			name:'',
			methods:{
				addName: function() {
					this.people.push(this.name);
					this.name='';
				}
			}
		});

var	urlUsers= 'https://jsonplaceholder.typicode.com/users';

new Vue({
			el:'#tecnica',
			created: function() {
				this.getUsers();
			},
			data:{
				people:[]
			},
			methods:{
				getUsers: function() {
					axios.get(urlUsers).then(reponse=>{
						this.people=reponse.data;
					});
				}
			}
		});