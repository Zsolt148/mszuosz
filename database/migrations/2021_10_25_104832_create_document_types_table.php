<?php

use App\Models\DocumentType;
use Database\Seeders\DocumentTypeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypesTable extends Migration
{
    const DOCUMENT_TYPES = [
        'default'   => 'Általános',
        'template'  => 'Sablon',
        'rule'      => 'Szabályzat',
        'report'    => 'Jegyzőkönyv',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_visible')->default(0);
            $table->timestamps();
        });

        Schema::table('documents', function (Blueprint $table) {
           $table->foreignId('document_type_id')->nullable()->after('date')->constrained()->nullOnDelete();
        });

//        Artisan::call('db:seed', ['--class' => DocumentTypeSeeder::class]);
//
//        DB::query()
//            ->select('*')
//            ->from('documents')
//            ->get()
//            ->each(function ($document) {
//                $doc = \App\Models\Document::findOrFail($document->id);
//
//                $doc->update([
//                    'document_type_id' => DocumentType::query()->firstWhere('name', self::DOCUMENT_TYPES[$document->type])->id
//                ]);
//            });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_types');

        Schema::table('documents', function(Blueprint $table) {
           $table->dropColumn('document_type_id');

            $table->string('type')->nullable()->after('date');
        });
    }
}
