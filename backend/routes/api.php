<?php


ini_set('max_execution_time', 6000);

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Material;
use App\Models\Partner;
use App\Models\PartnerMember;
use App\Models\Provinsi;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function (Request $r) {
    return User::all();
});
Route::get('/users/{id}', function (Request $r, int $id) {
    return User::query()->find($id);
});
Route::delete('/users/{id}', function (Request $r, int $id) {
    $u = User::query()->find($id);

    if ($u) {
        $u->delete();
    }

    return "OK";
});
Route::post('/users', function (Request $r) {
    $body = json_decode($r->getContent());

    $u = User::query()->updateOrCreate(['id' => isset($body?->id) ? $body?->id : null], (array) $body);
});

Route::get('/partners', function (Request $r) {
    $p = Partner::all();

    $p->each(function (Partner $p) {
        $p->partnerMembers;
    });


    return $p;
});
Route::get('/partners/{id}', function (Request $r, int $id) {
    $p =  Partner::query()->find($id);

    $p->partnerMembers;

    return $p;
});
Route::delete('/partners/{id}', function (Request $r, int $id) {
    Partner::query()->find($id)->delete();
});
Route::post('/partners', function (Request $r) {
    $body = json_decode($r->getContent());

    $p = Partner::query()->updateOrCreate(['id' => isset($body?->id) ? $body?->id : null], (array) $body);

    foreach ($body->partner_members as $m) {
        $m->partner_id = $p->id;

        PartnerMember::query()->updateOrCreate(['id' => isset($m->id) ? $m->id : null], (array) $m);
    }
});

Route::get('/materials', function (Request $r) {
    return Material::all();
});
Route::get('/materials/{id}', function (Request $r, int $id) {
    return Material::query()->find($id);
});
Route::delete('/materials/{id}', function (Request $r, int $id) {
    Material::query()->find($id)->delete();
});
Route::post('/materials', function (Request $r) {
    $body = json_decode($r->getContent());

    $u = Material::query()->updateOrCreate(['id' => isset($body?->id) ? $body?->id : null], (array) $body);
});

Route::get('/transactions', function (Request $r) {
    return Transaction::all()->map(function (Transaction $t) {
        $t->transactionItems;
        $t->supplier;

        return $t;
    });
});
Route::get('/transactions/{id}', function (Request $r, int $id) {
    $t = Transaction::query()->find($id);

    $t->transactionItems;
    $t->supplier;


    return $t;
});
Route::post('/transactions', function (Request $r) {
    $body = json_decode($r->getContent());

    $t = Transaction::query()->updateOrCreate(['id' => isset($body?->id) ? $body?->id : null], (array) $body);

    foreach ($body->transaction_items as $i) {
        $i->transaction_id = $t->id;
        $ti = TransactionItem::query()->updateOrCreate(['id' => isset($i?->id) ? $i?->id : null], (array) $i);
    }
});


Route::get('/provinsis', function (Request $r) {
    $allProvinsisRaw = json_decode(\File::get('../data-indo/provinsi.json'));

    // dd($allProvinsisRaw);
    return $allProvinsisRaw;
});

Route::get('/kabupatens/{id}', function (Request $r, int $id) {
    $data = json_decode(\File::get('../data-indo/kabupaten/' . $id . '.json'));

    return $data;
});

Route::get('/kecamatans/{id}', function (Request $r, int $id) {
    $data = json_decode(\File::get('../data-indo/kecamatan/' . $id . '.json'));

    return $data;
});

Route::get('/kelurahans/{id}', function (Request $r, int $id) {
    $data = json_decode(\File::get('../data-indo/kelurahan/' . $id . '.json'));

    return $data;
});





Route::get('/populate', function (Request $r) {

    $allProvinsisRaw = json_decode(\File::get('../data-indo/provinsi.json'));
    $allProvinsis = [];
    $allKabupatens = [];
    $allKecamatans = [];
    $allKelurahans = [];


    // Provinsi loop

    foreach ($allProvinsisRaw as $p) {
        $p->code = (int)$p->id;
        $p->id = null;
        $p->name = $p->nama;
        unset($p->nama);

        array_push($allProvinsis, (array) $p);
    }




    // Kabupaten loop
    $kabupatenDir = new DirectoryIterator('../data-indo/kabupaten');

    foreach ($kabupatenDir as $fileinfo) {
        if (!$fileinfo->isDot()) {
            $kabupatens = json_decode(\File::get('../data-indo/kabupaten/' . $fileinfo->getFilename()));

            if ($kabupatens !== null) {
                foreach ($kabupatens as $k) {
                    try {
                        $provinsiId = explode('.', $fileinfo->getFilename())[0];

                        $k->provinsi_id = (int)$provinsiId;
                        $k->code = (int)$k->id;
                        $k->id = null;
                        $k->name = $k->nama;
                        unset($k->nama);
                    } catch (Exception $e) {
                    }

                    // dd($k);
                    array_push($allKabupatens, (array) $k);
                }
            }
        }
    }



    // Kecamatan loop
    $kecamatanDir = new DirectoryIterator('../data-indo/kecamatan');

    foreach ($kecamatanDir as $fileinfo) {
        if (!$fileinfo->isDot()) {
            $kecamatans = json_decode(\File::get('../data-indo/kecamatan/' . $fileinfo->getFilename()));

            if ($kecamatans !== null) {
                foreach ($kecamatans as $k) {
                    try {
                        $kabupatenId = explode('.', $fileinfo->getFilename())[0];

                        $k->kabupaten_id = (int) $kabupatenId;
                        $k->code = (int)$k->id;
                        $k->id = null;
                        $k->name = $k->nama;
                        unset($k->nama);
                    } catch (Exception $e) {
                    }

                    array_push($allKecamatans, (array) $k);
                }
            }
        }
    }

    // Kelurahan loop
    $kelurahanDir = new DirectoryIterator('../data-indo/kelurahan');

    foreach ($kelurahanDir as $fileinfo) {
        if (!$fileinfo->isDot()) {
            $kelurahans = json_decode(\File::get('../data-indo/kelurahan/' . $fileinfo->getFilename()));

            if ($kelurahans !== null) {
                foreach ($kelurahans as $k) {
                    try {
                        $kecamatanId = explode('.', $fileinfo->getFilename())[0];

                        $k->kecamatan_id = (int) $kecamatanId;
                        $k->code = (int)$k->id;
                        $k->id = null;
                        $k->name = $k->nama;
                        unset($k->nama);
                    } catch (Exception $e) {
                    }

                    array_push($allKelurahans, (array) $k);
                }
            }
        }
    }


    // Upsert provinsis
    // dd([$allProvinsis]);      
    Provinsi::query()->upsert($allProvinsis, ['code'], ['name']);
    Kabupaten::query()->upsert($allKabupatens, ['code'], ['name', 'provinsi_id']);
    Kecamatan::query()->upsert($allKecamatans, ['code'], ['name', 'kabupaten_id']);
    Kelurahan::query()->upsert($allKelurahans, ['code'], ['name', 'kecamatan_id']);


    return [
        'provinsis' => $allProvinsis,
        'kabupatens' => $allKabupatens,
        'kecamatans' => $allKecamatans,
        'kelurahans' => $allKelurahans
    ];
});
