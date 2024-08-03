<script setup>
import { onMounted, ref, watch } from "vue";
import PropertyListItem from "./PropertyListItem.vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
import { Form, Field, useResetForm } from "vee-validate";
import * as yup from "yup";
import { useToastr } from "../../toastr.js";
import { debounce } from "lodash";
const properties = ref({ data: [] });


const getPropertyList = (page = 1) => {
    axios.get(`/api/properties?page=${page}`).then((response) => {
        properties.value = response.data;
    }).catch((error) => {
        console.log(error);
        if (error.response && error.response.status === 401) {
            router.push('/login')
        }
    });
};

const toastr = useToastr();
const users = ref({ data: [] });
const editing = ref(false);
const formValues = ref();
const form = ref(null);

const createPropertySchema = yup.object({
    name: yup.string().required(),
    image: yup.mixed().required().test('fileType', 'Invalid file format', (value) => {
        if (!value) return false; // Make sure a file is present
        // Check the file type (you may need to adjust this based on your requirements)
        return value && ['image/jpeg', 'image/png', 'image/gif'].includes(value.type);
    }),
    description: yup.string().required(),
    location: yup.string().required(),
    available_slot: yup.string().required(),
    member_slot_price: yup.string().required(),
    slot_price: yup.string().required(),
    investment_type: yup.string().required(),
    brochure_link: yup.string().required(),
});

const editPropertySchema = yup.object({
    name: yup.string().required(),
    last_name: yup.string().required(),
    phone_number: yup.string().required(),
    email: yup.string().email().required(),
    password: yup.string().when((password, schema) => {
        return password ? schema.required().min(8) : schema;
    }),
});

const propertyImage = ref('');

const createProperty = (values, { resetForm, setErrors }) => {
  const formData = new FormData();

    // Append each value from the form to formData
    Object.keys(values).forEach((key) => {
        formData.append(key, values[key]);
    });

    axios
        .post("/api/properties", formData)
        .then((response) => {
          properties.value.data.unshift(response.data);
            $("#propertyFormModal").modal("hide");
            resetForm();
            toastr.success("User created successfully!");
        })
        .catch((error) => {
            if (error.response.data.errors) {
                setErrors(error.response.data.errors);
            }
        });
};

const addProperty = () => {
    editing.value = false;
    $("#propertyFormModal").modal("show");
};

const editProperty = (user) => {
    editing.value = true;
    form.value.resetForm();
    $("#propertyFormModal").modal("show");
    formValues.value = {
        id: user.id,
        first_name: user.first_name,
        last_name: user.last_name,
        phone_number: user.phone_number,
        email: user.email,
    };
};

const updatePropery = (values, { setErrors }) => {
    axios
        .put("/api/properties/" + formValues.value.id, values)
        .then((response) => {
            const index = users.value.data.findIndex((user) => user.id === response.data.id);
            users.value.data[index] = response.data;
            $("#propertyFormModal").modal("hide");
            toastr.success("User updated successfully!");
        })
        .catch((error) => {
            setErrors(error.response.data.errors);
            console.log(error);
        });
};

const handleSubmit = (values, actions) => {
    // console.log(actions);
    if (editing.value) {
        updatePropery(values, actions);
    } else {
        createProperty(values, actions);
    }
};

const handleFileChange = (event) => {
    propertyImage.value = event.target.files[0];
};

const searchQuery = ref(null);

const selectedPropertiess = ref([]);
const toggleSelection = (user) => {
    const index = selectedPropertiess.value.indexOf(user.id);
    if (index === -1) {
        selectedPropertiess.value.push(user.id);
    } else {
        selectedPropertiess.value.splice(index, 1);
    }
    console.log(selectedPropertiess.value);
};

const userIdBeingDeleted = ref(null);
const confirmUserDeletion = (id) => {
    userIdBeingDeleted.value = id;
    $("#deletePropertyModal").modal("show");
};

const deleteProperty = () => {
    axios.delete(`/api/properties/${userIdBeingDeleted.value}`).then(() => {
        $("#deletePropertyModal").modal("hide");
        toastr.success("User deleted successfully!");
        users.value.data = users.value.data.filter(
            (user) => user.id !== userIdBeingDeleted.value
        );
    });
};

const bulkDelete = () => {
    axios
        .delete("/api/properties", {
            data: {
                ids: selectedPropertiess.value,
            },
        })
        .then((response) => {
            users.value.data = users.value.data.filter(
                (user) => !selectedPropertiess.value.includes(user.id)
            );
            selectedPropertiess.value = [];
            selectAll.value = false;
            toastr.success(response.data.message);
        });
};

const selectAll = ref(false);
const selectAllProperties = () => {
    if (selectAll.value) {
        selectedPropertiess.value = users.value.data.map((user) => user.id);
    } else {
        selectedPropertiess.value = [];
    }
    console.log(selectedPropertiess.value);
};

watch(
    searchQuery,
    debounce(() => {
        getPropertyList();
    }, 300)
);

onMounted(() => {
    getPropertyList();
});
</script>
<template lang="">
  <div>
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white ml-2 p-0 mb-0">Properties</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                    <div class="col-lg-12 col-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">  
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="d-flex justify-content-between p-2">
                            <div class="d-flex">
                                <button @click="addProperty" type="button" class="mb-2 btn btn-primary">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                    Add New Properties
                                </button>
                                <div v-if="selectedPropertiess.length > 0">
                                    <button
                                        @click="bulkDelete"
                                        type="button"
                                        class="ml-2 mb-2 btn btn-danger"
                                    >
                                        <i class="fa fa-trash mr-1"></i>
                                        Delete Selected
                                    </button>
                                    <span class="ml-2">Selected {{ selectedPropertiess.length }} users</span>
                                </div>
                            </div>
                            <div>
                                <input
                                type="text"
                                v-model="searchQuery"
                                class="form-control"
                                placeholder="Search..."
                                />
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <table class="table table-hover align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Property</th>
                                    <th scope="col">Property Location</th>
                                    <th scope="col">Slot Purchased</th>
                                    <th scope="col">Total Aount Invested</th>
                                    <th scope="col">Total Aount Invested</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                               <PropertyListItem v-for="(property, index) in properties.data" :key="property.id" :property=property :index=index />
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>

            <Bootstrap4Pagination 
                            :data="properties"
                            @pagination-change-page="getPropertyList"
                        />
        </div>
    </div>
    </div>
  </div>


  <div
    class="modal fade"
    id="propertyFormModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span v-if="editing">Edit Property</span>
            <span v-else>Add New Property</span>
          </h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <Form
          ref="form"
          @submit="handleSubmit"
          :validation-schema="editing ? editPropertySchema : createPropertySchema"
          v-slot="{ errors }"
          :initial-values="formValues"
        >
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Image</label>
              <Field
                name="image"
                type="file"
                class="form-control"
                :class="{ 'is-invalid': errors.image }"
                id="image"
                aria-describedby="imageHelp"
                placeholder="Enter image"
                @change="handleFileChange"
              />
              <span class="invalid-feedback">{{ errors.image }}</span>
            </div>
            <div class="form-group">
              <label for="name">Name of Property/Title</label>
              <Field
                name="name"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                id="name"
                aria-describedby="nameHelp"
                placeholder="Enter full name"
              />
              <span class="invalid-feedback">{{ errors.name }}</span>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <Field
                name="description"
                type="text"
                as="textarea"
                class="form-control"
                :class="{ 'is-invalid': errors.description }"
                id="description"
                aria-describedby="descriptionHelp"
                placeholder="Enter Description"
              />
              <!-- <Field name="description" v-slot="{ description }">
                    <textarea class="form-control" :class="{ 'is-invalid': errors.description }"  placeholder="Enter Description" v-bind="description" id="description" rows="5" />
                </Field> -->
              <span class="invalid-feedback">{{ errors.description }}</span>
            </div>          
            <div class="form-group">
              <label for="location">Location</label>
              <Field
                name="location"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.location }"
                id="location"
                aria-describedby="nameHelp"
                placeholder="Enter Location"
              />
              <span class="invalid-feedback">{{ errors.location }}</span>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="slot_price">Non-Members price per Slot</label>
                  <Field
                    name="slot_price"
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.slot_price }"
                    id="slot_price"
                    aria-describedby="nameHelp"
                    placeholder="Enter Non-Members price"
                  />
                  <span class="invalid-feedback">{{ errors.slot_price }}</span>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="member_slot_price">Members Only Price per Slot</label>
                  <Field
                    name="member_slot_price"
                    type="number"
                    class="form-control"
                    :class="{ 'is-invalid': errors.member_slot_price }"
                    id="member_slot_price"
                    aria-describedby="nameHelp"
                    placeholder="Enter member slot price"
                  />
                  <span class="invalid-feedback">{{ errors.member_slot_price }}</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="available_slot">Available Slots</label>
              <Field
                name="available_slot"
                type="number"
                class="form-control"
                :class="{ 'is-invalid': errors.available_slot }"
                id="available_slot"
                aria-describedby="nameHelp"
                placeholder="Enter available slots"
              />
              <span class="invalid-feedback">{{ errors.member_slot_price }}</span>
            </div>
            <div class="form-group">
              <label for="investment_type">Investment Type</label>
              <!-- <Field
                name="investment_type"
                as="select"
                class="form-control"
                :class="{ 'is-invalid': errors.investment_type }"
                id="investment_type"
                aria-describedby="nameHelp"
                placeholder="Enter Investment Type"
              >
              <option>Lease</option>
              <option>Own for Life</option>
              <option>Renovation</option>
              <option>Landlord Loans</option>
              </Field> -->
              <Field v-slot="{ value }" name="investment_type" as="select" class="form-control">
                <option value="" disabled>Select Investment Type</option>
                <option value="Lease">Lease</option>
                <option value="Own for Life">Own for Life</option>
                <option value="Renovation">Renovation</option>
                <option value="Landlord Loans">Landlord Loans</option>
              </Field>
              <span class="invalid-feedback">{{ errors.investment_type }}</span>
            </div>
            <div class="form-group">
              <label for="brochure_link">Brochure downloads Link</label>
              <Field
                name="brochure_link"
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.brochure_link }"
                id="brochure_link"
                aria-describedby="nameHelp"
                placeholder="Enter Brochure downloads Link"
              />
              <span class="invalid-feedback">{{ errors.brochure_link }}</span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancel
            </button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </Form>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="deletePropertyModal"
    data-backdrop="static"
    tabindex="-1"
    role="dialog"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">
            <span>Delete User</span>
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h5>Are you sure you want to delete this user ?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel
          </button>
          <button @click.prevent="deleteProperty" type="button" class="btn btn-primary">
            Delete User
          </button>
        </div>
      </div>
    </div>
  </div>
</template>