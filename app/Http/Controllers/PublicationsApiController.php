<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collection;
use App\Models\Contributor;
use App\Models\Finance;
use MailController;
use App\Models\Readers;
use App\Helpers\APIHelpers;

class PublicationsApiController extends Controller
{

    //all publications
    public function index()
    {
    $publications = Collection::all();
    $response = APIHelpers::createAPIResponse(false, 200,'', $publications);
    return response()->json($response,200); 
    }



    //all publications for a particular owner
    public function single()
    {
    $publications = Collection::all()->where('email',request('email'));
    $response = APIHelpers::createAPIResponse(false, 200,'', $publications);
    return response()->json($response,200); 
    }

    //focus on one publication by id
    public function singlepub(Collection $id)
    {
      $publications = Collection::find($id);
      $response = APIHelpers::createAPIResponse(false, 200,'', $publications);
      return response()->json($response,200); 
    }


    //update publication
    public function update(Collection $id)
    {
          $success = $id ->update([
            'title' => request('title'),
            'price' => request('price'),
            'author'=> request('author'),
            'email'=> request('email'),
            'filetype'=> request('filetype'),
            'photoURL'=> request('photoURL'),
            'rating' => request('rating'),
            'readers'=> request('readers'),
            'percentage'=> request('percentage'),
            'description' => request('description'),
            'bookcover' => request('bookcover'),
            'date' => request('date'),
            'downloadable' => request('downloadable'),
            'book' => request('book'),
            'timestamp' => request('timestamp'),
            'earnings' => request('earnings'),
            'slug' => request('slug'),
            'currency'=> request('currency'),
            'coauthor' => request('coauthor'),
            'category' => request('category'),
         ]);
             if($success){
                $response = APIHelpers::createAPIResponse(false, 200,'Your publication has been updated successfully', null);
                return response()->json($response,200); 
             } else{
                $response = APIHelpers::createAPIResponse(false, 400,'Sorry, the publication was not updated!', null);
                return response()->json($response,400); 
             }
    }

    //create new publication 
    public function create()
    {
        $success = Collection::create([
            'title' => request('title'),
            'price' => request('price'),
            'author'=> request('author'),
            'email'=> request('email'),
            'filetype'=> request('filetype'),
            'photoURL'=> request('photoURL'),
            'rating' => request('rating'),
            'readers'=> request('readers'),
            'percentage'=> request('percentage'),
            'description' => request('description'),
            'bookcover' => request('bookcover'),
            'date' => request('date'),
            'downloadable' => request('downloadable'),
            'book' => request('book'),
            'timestamp' => request('timestamp'),
            'earnings' => request('earnings'),
            'slug' => request('slug'),
            'status'=>request('status'),
            'currency'=> request('currency'),
            'coauthor' => request('coauthor'),
            'category' => request('category'),
        ]);

        if($success){
            $response = APIHelpers::createAPIResponse(false, 200,'Congratulations! You have successfully created a publication on Tell! Books', null);
            return response()->json($response,200); 
        }else{
            $response = APIHelpers::createAPIResponse(false, 400,'Sorry, your publication was not successfully created. Do try again', null);
            return response()->json($response,400); 
        }
    }

    //fetch contributors to a publication
    public function fetch(){
        $contributors = Collection::find(request('id'))->contributors;
        $response = APIHelpers::createAPIResponse(false, 200,'', $contributors);
        return response()->json($response,200); 
    }

    //delete a publication
    public function delete(Collection $id){
            $success = $id->delete();
            if($success){
                $response = APIHelpers::createAPIResponse(false, 200,'Publication deleted Successfully',null );
                return response()->json($response,200); 
            }
    }

    public function contributors(){
        $contributors = Contributor::all();
        $response = APIHelpers::createAPIResponse(false, 200,'',$contributors);
        return response()->json($response,200); 
       
    }

    public function singlecontributor(Contributor $id){
        $contributor = Contributor::find($id);
        $response = APIHelpers::createAPIResponse(false, 200,'',$contributor);
        return response()->json($response,200); 
    }

    public function contribute(){
        $contributor = Contributor::create([
            'name' => request('name'),
            'email' => request('email'),
            'photoURL' => request('photoURL'),
            'balance' => request('balance'),
            'file' => request('file'),
            'collection_id' => request('collection_id')
        ]);

        if($contributor){
            $response = APIHelpers::createAPIResponse(false, 200,'Congratulations, you have successfully submitted an entry for ', null);
            return response()->json($response,200); 
        } else{
            $response = APIHelpers::createAPIResponse(false, 400,'Sorry, your contribution has not been submitted', null);
            return response()->json($response,400); 
        }
    }


    //rejecting a contributor
    public function contributordelete(Contributor $id){
        $success = $id->delete();
        if($success){
            $response = APIHelpers::createAPIResponse(false, 200,'Contribution rejected successfully', null);
            return response()->json($response,200); 
        } else{
            $response = APIHelpers::createAPIResponse(false, 400,'Error encounted while rejecting contribution', null);
            return response()->json($response,400); 
        }
    }

    //when someone buys the publication
    public function buybook(){
        $contributors = Collection::find(request('id'))->contributors;
        $percentage = Collection::find(request('id'))->percentage;
        $ownerEmail = Collection::find(request('id'))->email;
        $ownerName = Collection::find(request('id'))->author;
        $price = Collection::find(request('id'))->price;
        $title = Collection::find(request('id'))->title;
        $bookcover = Collection::find(request('id'))->bookcover;
        $author = Collection::find(request('id'))->author;
        $currency = Collection::find(request('id'))->currency;
        $email = request('email');
        $name = request('name');
        $filetype = Collection::find(request('id'))->filetype;
        $category = Collection::find(request('id'))->category;
        $book = Collection::find(request('id'))->book;
        $price = Collection::find(request('id'))->price;
        $rating = Collection::find(request('id'))->rating;
        $description = Collection::find(request('id'))->description;
        $slug = Collection::find(request('id'))->slug;
        $photoURL = Collection::find(request('id'))->photoURL;
        $ownersPay = $price * (1- $percentage);

        $readersData = Readers::create([
            'uid'=> request('uid'),
            'currency' => $currency,
            'title'=> $title,
            'bookcover' => $bookcover,
            'author'=>$author,
            'email'=>$email,
            'name'=>$name,
            'filetype'=>$filetype,
            'photoURL'=>$photoURL,
            'slug' => $slug,
            'description'=> $description,
            'category'=> $category,
            'book' => $book,
            'price'=> $price,
            'rating'=>$rating,
            'collection_id' => request('id')
        ]);

        


        $ownersShare = Finance::create([
          'wallet' => $ownersPay,
          'currency' => $currency,
          'email' => $ownerEmail,
          'notification' => "New purchase for your book $title",
          'usertype'=>"Owner"
        ]);

         

        foreach($contributors as $contributor){
          $success = Finance::create([
          'wallet' => ($price * $percentage)/count($contributors),
          'currency' => $currency,
          'email' => $contributor['email'],
          'notification' => "New purchase for your publication $title",
          'usertype'=>"Contributor"
          ]);
        }
        
        if($success){
            $response = APIHelpers::createAPIResponse(false, 200,'Book Purchased Successfully', null);

            //email notification to publication owner

            $mailData = [
                'recipient' => $ownerEmail,
                 'name' => $ownerName,
                 'subject'=> "Your Publication, $title, just got purchased!",
                 'body' => "$name has just bought your publication, $title",
                 'from' => 'hello.tellbooks@gmail.com'
            ];
            \Mail::send('email-template',$mailData,function($message) use ($mailData){
                $message ->to($mailData['recipient'])
                         ->from($mailData['from'],'Tell! Books')
                         ->subject($mailData['subject']);
            });



            //email notification to contributors
            foreach($contributors as $contributor){
                $mailData = [
                    'recipient' => $contributor->email,
                     'name' => $contributor->name,
                     'subject'=> "Your Publication, $title, just got purchased!",
                     'body' => "$name has just bought your publication, $title",
                     'from' => 'hello.tellbooks@gmail.com'
                ];
                \Mail::send('email-template',$mailData,function($message) use ($mailData){
                    $message ->to($mailData['recipient'])
                             ->from($mailData['from'],'Tell! Books')
                             ->subject($mailData['subject']);
                });
            }



            return response()->json($response,200); 
        } else{
            $response = APIHelpers::createAPIResponse(false, 400,'Error encounted while purchasing book', null);
            return response()->json($response,400); 
        }
    }

    // public function getmoney(){
    //     return Finance::find($id);
    // }

    //get balance from sales of publication for user and owner of publication
    public function balance(){
       $users = Finance::all()->where('email',request('email'));
       $sum = 0;
       foreach($users as $user){
          $sum+=$user->wallet;
       }
       $response = APIHelpers::createAPIResponse(false, 200,'',$sum);
       return response()->json($response,200); 
    }
 

    //get all books in a reader's library
    public function reader(){
       $books = Readers::all()->where('uid',request('uid'));
       $response = APIHelpers::createAPIResponse(false, 200,'',$books);
        return response()->json($response,200); 
    }

    //get all the readers of a book
    public function getReaders(){
        $readers = Collection::find(request('id'))->myreaders;
        error_log($readers);
        $response = APIHelpers::createAPIResponse(false, 200,'',$readers);
        return response()->json($response,200); 
    }
}

