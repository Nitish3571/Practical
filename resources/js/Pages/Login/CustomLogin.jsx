import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function CustomLogin() {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
    });

    const { flash } = usePage().props;

    const submit = (e) => {
        e.preventDefault();

        post(route('customs.login'), {
            onFinish: () => {
                reset('email', 'password')
            },
        });
    };

    return (
        <GuestLayout>
            <Head title="Login Page" />

            {flash?.success && (
                <div className="bg-green-500 text-white p-3 rounded-md text-center my-4">
                    {flash.success}
                </div>
            )}

            {flash?.error && (
                <div className="bg-green-500 text-white p-3 rounded-md text-center my-4">
                    {flash.error}
                </div>
            )}

            <h2 className='text-2xl text-center py-2'>Login Page</h2>
            <form onSubmit={submit}>

                <div className="mt-4">
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4 flex items-center justify-end">

                    <PrimaryButton className="ms-4" disabled={processing}>
                        Login
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    );
}
