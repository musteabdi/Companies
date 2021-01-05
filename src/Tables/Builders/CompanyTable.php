<?php

namespace LaravelEnso\Companies\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Tables\Contracts\Table;

class CompanyTable implements Table
{
    protected const TemplatePath = __DIR__.'/../Templates/companies.json';

    public function query(): Builder
    {
        return App::make(Company::class)->selectRaw('
            companies.id, companies.name,  companies.fiscal_code,  people.name as mandatary,
            companies.email, companies.website, companies.bank,  companies.pays_vat, 
            companies.phone,  companies.status, companies.is_tenant, companies.created_at
        ')->leftJoin(
            'company_person',
            fn ($join) => $join
                ->on('companies.id', '=', 'company_person.company_id')
                ->where('company_person.is_mandatary', true)
        )->leftJoin('people', 'company_person.person_id', '=', 'people.id');
    }

    public function templatePath(): string
    {
        return static::TemplatePath;
    }
}
