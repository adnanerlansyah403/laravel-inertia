<!-- /resources/Pages/Auth/Register.vue -->
<template>
    <Head title="Register" />
    <div class="w-full max-w-sm bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-6">Buat akun baru anda</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    v-model="form.email"
                    @input="form.validate('email')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('email')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['email'] }}
                </div>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    @input="form.validate('name')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('name')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['name'] }}
                </div>
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input
                    type="tel"
                    id="phone"
                    v-model="form.phone"
                    @input="form.validate('phone')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('phone')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['phone'] }}
                </div>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input
                    type="text"
                    id="address"
                    v-model="form.address"
                    @input="form.validate('address')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('address')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['address'] }}
                </div>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    v-model="form.password"
                    @input="form.validate('password')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('password')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['password'] }}
                </div>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    @input="form.validate('password_confirmation')"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                />
                <div v-if="form.invalid('password_confirmation')" class="text-red-500 text-sm mt-1">
                    {{ form.errors['password_confirmation'] }}
                </div>
            </div>
            <button
                type="submit"
                class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none"
            >
                {{ form.processing ? 'Mendaftar...' : 'Daftar' }}
            </button>
        </form>
        <p class="text-center mt-4">
            Sudah punya akun? <Link href="/auth/login" class="text-blue-500">Login</Link>
        </p>
    </div>
</template>

<script setup>
import { useForm } from 'laravel-precognition-vue-inertia';
import AuthLayout from '@/Layouts/AuthLayout.vue'

defineOptions({ layout: AuthLayout })

const form = useForm('post', '/auth/register', {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '',
    address: '',
})

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset()
})

</script>
