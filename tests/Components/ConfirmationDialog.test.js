// tests/Components/ConfirmationDialog.test.js
import { mount } from '@vue/test-utils';
import ConfirmationDialog from '@/Components/ConfirmationDialog.vue';
import { describe, it } from 'vitest';

describe('ConfirmationDialog', () => {
    it('renders the title and message correctly', () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: true,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Memastikan title dan message dirender
        expect(wrapper.text()).toContain('Konfirmasi Aksi');
        expect(wrapper.text()).toContain('Apakah Anda yakin ingin melanjutkan?');
    });

    it('emits "cancel" event when the cancel button is clicked', async () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: true,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Temukan tombol "Batal" dan klik
        const cancelButton = wrapper.find('button.bg-gray-300');
        await cancelButton.trigger('click');

        // Pastikan event "cancel" teremit
        expect(wrapper.emitted()).toHaveProperty('cancel');
    });

    it('emits "confirm" event when the confirm button is clicked', async () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: true,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Temukan tombol "Konfirmasi" dan klik
        const confirmButton = wrapper.find('button.bg-red-600');
        await confirmButton.trigger('click');

        // Pastikan event "confirm" teremit
        expect(wrapper.emitted()).toHaveProperty('confirm');
    });

    it('emits "cancel" event when clicking on the backdrop', async () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: true,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Klik backdrop
        const backdrop = wrapper.find('div.absolute');
        await backdrop.trigger('click');

        // Pastikan event "cancel" teremit
        expect(wrapper.emitted()).toHaveProperty('cancel');
    });

    it('emits "closed" event when animation ends', async () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: true,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Simulasikan animasi selesai
        const modal = wrapper.find('div.bg-white');
        await modal.trigger('animationend');

        // Pastikan event "closed" teremit
        expect(wrapper.emitted()).toHaveProperty('closed');
    });

    it('does not render the dialog when "show" is false', () => {
        const wrapper = mount(ConfirmationDialog, {
            props: {
                show: false,
                title: 'Konfirmasi Aksi',
                message: 'Apakah Anda yakin ingin melanjutkan?',
            },
        });

        // Pastikan modal tidak dirender
        expect(wrapper.find('div.fixed').exists()).toBe(false);
    });
});
