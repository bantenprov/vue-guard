<template>
    <div>
		<div class="card mb-3">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<span>
					<i class="fa fa-table" aria-hidden="true"></i> Guard [ {{ model.label }} ]
				</span>
				<button class="btn btn-primary btn-sm ml-2" role="button" @click="back">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
			</div>

			<div class="card-body">
				<dl class="row">
					<dt class="col-2">Name</dt>
					<dd class="col-10">{{ model.name }}</dd>
					
					<dt class="col-2">Label</dt>
					<dd class="col-10">{{ model.label }}</dd>      

                    <dt class="col-2">Workflow</dt>
                    <dd class="col-10">{{ model.workflow.label }}</dd> 

                    <dt class="col-2">Transition</dt>
					<dd class="col-10">{{ model.transition.label }}</dd> 
                    
                    <dt class="col-2">Permission</dt>
					<dd class="col-10">{{ model.permission.display_name }}</dd> 
				</dl>
			</div>
		
	    </div>
  </div>
  
</template>

<script>
export default {
  mounted() {
    axios.get('vue-guard/' + this.$route.params.id + '/show')
      .then(response => {
        if (response.data.status == true) {
          this.model.label = response.data.label;          
          this.model.name = response.data.name;          
          this.model.workflow = response.data.workflow;
          this.model.transition = response.data.transition;
          this.model.permission = response.data.permission;
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break1');
        window.location.href = '#/admin/workflow/guard';
	  });
  },
  data() {
    return {
      state: {},
      model: {
        label: "",
        name: "",
        workflow:"",
        transition: "",
        permission: ""
	  }
    }
  },
  methods: {
	toast_message(typem,title,message,event) {
      switch (typem) {
        case 'success':
          miniToastr.success(message, title);
          break;
        case 'error':
          miniToastr.error(message, title);          
          break;
        case 'info':
          miniToastr.info(message, title);     
          break;
      }      
    },
    onSubmit: function() {
      let app = this;
      if (this.state.$invalid) {
        return;
      } else {
        // axios.post('vue-workflow/workflow/' + this.$route.params.id + '/store-workflow', {
        //     content_type: this.model.content_type.label,
        //     workflow_type: this.model.workflow_type.label
        //   })
        //   .then(response => {
        //     if (response.data.status == true) {              
        //         app.toast_message('success','add success',response.data.message);
        //         app.back();              
        //     } else {
        //       app.toast_message('error','add failed',response.data.message);
        //     }
        //   })
        //   .catch(function(response) {
        //     alert('Break ' + response.data.message);
        //   });
      }
    },
    back() {
      window.location = '#/admin/workflow/guard';
    }
  }
}
</script>
