<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Edit Guard

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
        <div class="form-row">
          <div class="col-md">
            <validate tag="div">
              <label for="name">Name</label>
              <input class="form-control" v-model="model.name" required autofocus name="name" type="text" placeholder="Name">

              <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Name is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
          <div class="col-md">
            <validate tag="div">
              <label for="label">Label</label>
              <input class="form-control" v-model="model.label" required autofocus name="label" type="text" placeholder="Label">

              <field-messages name="label" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Label is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4">
            <div class="col-md">
                <validate tag="div">
                <label for="workflow">Workflow</label>
                <v-select name="workflow" @input="onChange" v-model="model.workflow" :options="workflows" required autofocus placeholder="Select Workflow" class="mb-4"></v-select>

                <field-messages name="workflow" show="$invalid && $submitted" class="text-danger">
                    <small class="form-text text-success">Looks good!</small>
                    <small class="form-text text-danger" slot="required">Workflow is a required field</small>
                </field-messages>
                </validate>
            </div>
        </div>

        <div class="form-row mt-4">
            <div class="col-md">
                <validate tag="div">
                <label for="from">Transition</label>
                <v-select name="transition" v-model="model.transition" :options="transitions" required autofocus placeholder="Select Transition" class="mb-4"></v-select>

                <field-messages name="transition" show="$invalid && $submitted" class="text-danger">
                    <small class="form-text text-success">Looks good!</small>
                    <small class="form-text text-danger" slot="required">Transition is a required field</small>
                </field-messages>
                </validate>
            </div>
        </div>

        <div class="form-row mt-4">
            <div class="col-md">
                <validate tag="div">
                <label for="permission">Permission</label>
                <v-select name="permission" v-model="model.permission" :options="permissions" required autofocus placeholder="Select Permission" class="mb-4"></v-select>

                <field-messages name="permission" show="$invalid && $submitted" class="text-danger">
                    <small class="form-text text-success">Looks good!</small>
                    <small class="form-text text-danger" slot="required">Permission is a required field</small>
                </field-messages>
                </validate>
            </div>
        </div>
        <div class="form-row mt-4">
            <div class="col-md">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
            </div>
        </div>
      </vue-form>
    </div>
  </div>
</template>

<script>
export default {
  mounted(){
    axios.get('vue-guard/create')
    .then(response => {
      response.data.workflows.forEach(workflow => {
        this.workflows.push(workflow);
      });

      // response.data.transitions.forEach(transition => {
      //   this.transitions.push(transition);
      // });

      response.data.permissions.forEach(permission => {
        this.permissions.push(permission);
      });
    })
    .catch(function(response) {
      app.toast_message('error','error','#404 / #500');
    });
    axios.get('vue-guard/' + this.$route.params.id + '/edit')
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
        name: "",
        label: "",
        workflow: "",
        transition: "",
        permission: ""
      },
      workflows: [],
      transitions: [],
      permissions: [],
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
    onChange() {
      this.transitions = [];

      axios.get('vue-guard/'+this.model.workflow.id+'/get-transition')
      .then(response => {
        response.data.forEach(element => {
          //console.log(this.model.workflow.id);
          this.transitions.push(element);
        });
      })
      .catch(function(response) {
        app.toast_message('error','add failed','#500');
      });

    },
    onSubmit: function() {
      let app = this;
      if (this.state.$invalid) {
        return;
      } else {
        axios.put('vue-guard/'+this.$route.params.id+'/update', {
            name: this.model.name,
            label: this.model.label,
            workflow_id: this.model.workflow.id,
            transition_id: this.model.transition.id,
            permission_id: this.model.permission.id
          })
          .then(response => {

            if (response.data.status == true) {
                app.toast_message('success','add success',response.data.message);
                app.back();
            } else {
              app.toast_message('error','add failed',response.data.message);
            }
          })
          .catch(function(response) {
            app.toast_message('error','add failed','#500');
          });
      }
    },
    reset() {
      this.model = {
          label: "",
          name: "",
          permission: "",
          workflow: "",
          transition: "",
      };
    },
    back() {
      window.location = '#/admin/workflow/guard';
    }
  }
}
</script>
