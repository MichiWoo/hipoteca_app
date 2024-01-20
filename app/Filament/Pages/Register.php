<?php

namespace App\Filament\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Notifications\Notification;

class Register extends BaseRegister
{
	public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();

        $user = $this->getUserModel()::create($data);

        $this->sendEmailVerificationNotification($user);

		redirect($to = '/gestor/login');
        return null;
    }

	protected function getNameFormComponent(): Component
	{
		return TextInput::make('name')
			->label('Nombre Completo')
			->required()
			->maxLength(255)
			->autofocus();
	}

	protected function getEmailFormComponent(): Component
	{
		return TextInput::make('email')
			->label('Correo Electónico')
			->email()
            ->required()
            ->maxLength(255)
            ->unique($this->getUserModel());
	}

	protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label(__('Contraseña'))
            ->password()
            ->required()
            ->rule(Password::default())
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute'));
    }

	protected function getPasswordConfirmationFormComponent(): Component
	{
		return TextInput::make('passwordConfirmation')
			->label('Confirmar Contraseña')
			->password()
			->required()
			->dehydrated(false);
	}

	public function getTitle(): string | Htmlable
    {
        return __('Registro');
    }

	public function getHeading(): string | Htmlable
    {
        return __('Registro');
    }

	public function loginAction(): Action
    {
        return Action::make('login')
            ->link()
            ->label(__('loguearse con su cuenta'))
            ->url(filament()->getLoginUrl());
    }

	public function getRegisterFormAction(): Action
    {
        return Action::make('register')
            ->label(__('Registrar'))
            ->submit('register');
    }

}
