<?php

namespace Database\Factories;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PessoaFactory extends Factory
{
    protected $model = Pessoa::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => $this->gerarCPF(),
            'rg' => $this->faker->unique()->numerify('##############'), // Ajuste conforme necessário para o formato do RG
            'data_nasc' => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('d-m-Y'),
            'sexo' => $this->faker->randomElement(['masculino', 'feminino']),
            // outros atributos da pessoa...
        ];
    }

    public function gerarCPF() {
        $noveDigitos = '';
        for ($i = 0; $i < 9; $i++) {
            $noveDigitos .= mt_rand(0, 9);
        }

        $cpf = $noveDigitos . $this->calculaDigitosVerificadores($noveDigitos);

        return $this->formatarCPF($cpf);
    }

    public function calculaDigitosVerificadores($noveDigitos) {
        // Implemente a lógica de cálculo dos dígitos verificadores aqui
    }

    public function formatarCPF($cpf) {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
}
