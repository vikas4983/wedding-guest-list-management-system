<?php

namespace App\Http\Controllers;

use App\Exports\ContactExport;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUploadRequest;
use App\Http\Requests\GuestCreateRequest;
use App\Imports\ContactImport;
use App\Models\Guest;
use App\Models\ImportLog;
use App\Services\StaticDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $staticDataService;
    public function index(StaticDataService $staticDataService)
    {
        $this->staticDataService = $staticDataService;
        $data = $this->staticDataService->getData();
        $contacts = Contact::latest()->paginate(10);
        return view('contacts.index', compact('contacts', 'data'));
    }

    public function export()
    {
        return Excel::download(
            new class(
                Guest::where('status', 1)->get()
                    ->map(fn($r) => ['type' => 'guest', 'name' => $r->name, 'email' => $r->email, 'phone' => $r->phone])
                    ->merge(
                        Contact::where('status', 1)->get()
                            ->map(fn($r) => ['type' => 'contact', 'name' => $r->name, 'email' => $r->email, 'phone' => $r->phone])
                    )
            ) implements FromCollection, WithHeadings {
                public function __construct(private $rows) {}
                public function collection()
                {
                    return $this->rows;
                }
                public function headings(): array
                {
                    return ['name', 'email', 'phone'];
                }
            },
            'guests.xlsx'
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactUploadRequest $request)
    {
        $validatedData = $request->validated();
        try {
            if (!$request->hasFile('file')) {
                $message = 'No file uploaded';
                if ($request->ajax() || $request->wantsJson()) {
                    return api_error($message);
                }
                return back()->withErrors(['file' => $message])->withInput();
            }
            $file = $request->file('file');
            $fileHash = hash_file('sha256', $file->getRealPath());
            if (ImportLog::where('file_hash', $fileHash)->exists()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return api_error('File alreday uploaded');
                }
                return back()->withErrors(['file' => 'File alreday uploaded'])->withInput();
            }
            Excel::import(new ContactImport, $file);
            ImportLog::create([
                'file_hash' => $fileHash,
                'original_name' => $file->getClientOriginalName(),
                'file_hash' => $fileHash,
                'user_id' => auth()->id(),
            ]);
            return redirect()->back()->with('success', 'File successfully imported');
        } catch (\Throwable $th) {
            Log::error('File uploading failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return back()->withErrors(['file' => 'Something went wrong'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Contact $contact)
    {
        try {
            $objectdata = $contact;
            $editForm = view('forms.edit.contactForm', compact('objectdata'))->render();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'edit',
                    'editForm' => $editForm
                ]);
            }
            return view('contacts.edit', compact('objectdata'));
        } catch (\Throwable $th) {
            if ($request->ajax() || $request->wantsJson()) {
                Log::info('Data not found' . $th->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',

                ]);
            }
            Log::info('Data not found' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            $contact->update($request->all());
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'action' => 'update',
                    'message' => 'Guest updated successfully',
                ]);
            }
            return redirect()->route('contacts.index')->with('success', 'Guest updated successfully');
        } catch (\Throwable $th) {
            Log::info('Updation failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                Log::info('Updation failed' . $th->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                ]);
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Contact $contact)
    {
        try {
            $contact->destroy($contact->id);
            if ($request->ajax() || $request->wantsjson()) {
                return response()->json([
                    'action' => 'delete',
                    'success' => 'true',
                    'message' => 'Item deleted successfully',
                ]);
            }
        } catch (\Throwable $th) {
            Log::error('Deletion failed' . $th->getMessage());
            if ($request->ajax() || $request->wantsJson()) {
                return api_error('Something went wrong');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
