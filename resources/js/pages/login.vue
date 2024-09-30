<script setup>

    import AuthProvider from '@/views/pages/authentication/AuthProvider.vue'
    import logo from '@images/logo.svg?raw'
    import authV1BottomShape from '@images/svg/auth-v1-bottom-shape.svg?url'
    import authV1TopShape from '@images/svg/auth-v1-top-shape.svg?url'
    import netImg from '@images/net.png'
    import imgNet from '@images/net.svg?raw'

    import axios from 'axios';
    import { useRouter } from 'vue-router'

    import Swal from 'sweetalert2/dist/sweetalert2.js'
    import 'sweetalert2/src/sweetalert2.scss'

    import Toastify from 'toastify-js'
    import "toastify-js/src/toastify.css"

    let imglogo = netImg
    const router = useRouter()

    const form = ref({
    email: '',
    password: '',
    remember: false,
    })

    const isPasswordVisible = ref(false)

    const copiarDato = (dato) => {
        navigator.clipboard.writeText(dato)
        /* Swal.fire({
            position: "top-end",
            icon: "success",
            text: "Dato copiado = "+dato+" ",
            showConfirmButton: false,
            timer: 1500
        }); */
        Toastify({
            text: "Dato copiado = "+dato+" ",
            className: "info",
            style: {
                background: "linear-gradient(to right, #696cfad9, #696cfad9)",
            }
        }).showToast();
    };

    const validarUsuario = async () => {
        let password = form.value.password.trim();
        let email = form.value.email.trim();
        if ( password == '' || email == '') {
            Swal.fire({
                title: 'Error!',
                text: 'El formulario debe estar completo',
                icon: 'error',
                showConfirmButton: false,
            });
            return;
        }
        await axios.post('/ValidarUsuarioContrasena',{
            password:password,
            email:email,
        })
        .then(res => {
            if (res.data.request === true) {
                router.replace({ path: '/dashboard' });
            }else if (res.data.request === false){
                Swal.fire({
                    title: 'Error!',
                    text: 'Contraseña o mail incorrectos',
                    icon: 'error',
                    showConfirmButton: false,
                });
            }
        }).catch(function(error){
            location.reload();
        })
    }


</script>

<template>
    <div class="auth-wrapper d-flex align-center justify-center pa-4">
        <div class="position-relative my-sm-16">
            <VCard
                class="auth-card"
                max-width="460"
                :class="$vuetify.display.smAndUp ? 'pa-6' : 'pa-0'"
            >
                <VCardItem class="justify-center">
                <RouterLink
                    to="/"
                    class="app-logo"
                >
                    <div
                        class="d-flex"
                        v-html="imgNet"
                    />
                    <h1>
                        Netcommerce
                    </h1>
                </RouterLink>
                </VCardItem>

                <VCardText>
                <h4 class="text-h4 mb-1 text-center">
                    Welcome to Netcommerce! 👋🏻
                </h4>
                <p class="mb-0 text-center ">
                    Por favor, ingresa a tu cuenta para iniciar la aventura.
                </p>

                <VRow cols="12" class="justify-center mt-1 mb-3">
                    <h4 class="text-center m-1">
                        usuario@gmail.com 
                    </h4>
                    <v-btn 
                        density="compact"
                        append-icon="$vuetify" 
                        variant="outlined"
                        v-on:click="copiarDato('usuario@gmail.com')"
                        class="ml-2">
                        Copiar
                    </v-btn>
                </VRow>
                <VRow cols="12" class="justify-center mt-1 mb-3">
                    <h4 class="text-center m-1">
                        123456789 
                    </h4>
                    <v-btn 
                        density="compact"
                        append-icon="$vuetify" 
                        variant="outlined"
                        v-on:click="copiarDato('123456789')"
                        class="ml-2">
                        Copiar
                    </v-btn>
                </VRow>

                </VCardText>

                <VCardText>
                <VForm @submit.prevent="validarUsuario">
                    <VRow>
                    <!-- email -->
                    <VCol cols="12">
                        <VTextField
                        v-model="form.email"
                        autofocus
                        label="Email or Username"
                        type="email"
                        placeholder="johndoe@email.com"
                        />
                    </VCol>

                    <!-- password -->
                    <VCol cols="12">
                        <VTextField
                        v-model="form.password"
                        label="Password"
                        placeholder="············"
                        :type="isPasswordVisible ? 'text' : 'password'"
                        :append-inner-icon="isPasswordVisible ? 'bx-hide' : 'bx-show'"
                        @click:append-inner="isPasswordVisible = !isPasswordVisible"
                        />

                        <!-- remember me checkbox -->
                        <!-- <div class="d-flex align-center justify-space-between flex-wrap my-6">
                            <VCheckbox
                                v-model="form.remember"
                                label="Remember me"
                            />

                            <a
                                class="text-primary"
                                href="javascript:void(0)"
                            >
                                Forgot Password?
                             </a>
                        </div> -->

                        <!-- login button -->
                        
                    </VCol>
                    
                    <VCol>
                        <VBtn
                            block
                            type="submit"
                        >
                            Login
                        </VBtn>
                    </VCol>
                    

                    <!-- create account -->
                    <!-- <VCol
                        cols="12"
                        class="text-body-1 text-center"
                    >
                        <span class="d-inline-block">
                        New on our platform?
                        </span>
                        <RouterLink
                        class="text-primary ms-1 d-inline-block text-body-1"
                        to="/register"
                        >
                        Create an account
                        </RouterLink>
                    </VCol> -->

                    <VCol
                        cols="12"
                        class="d-flex align-center"
                    >
                        <VDivider />
                        <span class="mx-4 text-high-emphasis">or</span>
                        <VDivider />
                    </VCol>

                    <!-- auth providers -->
                    <VCol
                        cols="12"
                        class="text-center"
                    >
                        <AuthProvider />
                    </VCol>
                    </VRow>
                </VForm>
                </VCardText>
            </VCard>
        </div>
    </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth.scss";
</style>
