<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GalleryController extends AbstractController
{

    /**
     * @Route("/gallery", name="gallery",methods={"get"})
     */
    public function index(PhotoRepository $photoRepo):Response
    {        
        $photos=$photoRepo->findAll();
        return $this->render('gallery/index.html.twig',['photos'=>$photos]);
    }

    /**
     * @Route("/gallery/show/{id}",name="show")
     */
    public function show(PhotoRepository $photoRepo, int $id):Response
    {
        $photo=$photoRepo->find($id);
        if(!$photo){
            throw $this->createNotFoundException('Photo = '.$id.' non trouvée');
        }

        return $this->render('gallery/photo.html.twig', compact('photo'));
    }


    /**
     * @Route("/addPhoto",name="addPhoto", methods={"get","post"})
     */
    public function addPhoto(Request $request, EntityManagerInterface $em)
    {
        // if($request->isMethod("post")){
        //     $data=$request->request->all();

        //     $photo=new Photo;
        //     $photo->setTitle($data['title']);
        //     $photo->setDescription($data['description']);
            
        //     $em->persist($photo);
        //     $em->flush();
        //     return $this->redirectToRoute('home');
        // }

        $photo=new Photo;

        $form=$this->createFormBuilder($photo)
        ->add('title',null,[
            'required'=>true,
            'attr'=>['autofocus'=>true]
        ])
        ->add('description',TextareaType::class,[
            'required'=>true,
            'attr'=>[
                'rows'=>10,
                'cols'=>50
            ]
        ])
       
        ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute('show',['id'=>$photo->getId()]);
        }

        return $this->render('admin/addPhoto.html.twig',[
            'addPhotoForm'=>$form->createView()
            ]);
    }
}
