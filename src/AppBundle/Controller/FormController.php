<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{
    /**
     * @Route("/{_locale}/form",name="form")//duong dan
     */
   public function createnew(Request $request)
   {

        $task = new Task();
        $task->setDueDate(new \DateTime('tomorrow'));
        $task->setEndDate(new \DateTime('tomorrow'));
        
        

        $form = $this->createFormBuilder($task)

            ->add('task', TextType::class,['label'=>'form.project'])
            ->add('person', TextType::class,['label'=>"form.work"])
            ->add('dueDate', DateType::class,['label'=>'form.begin'])
            ->add('endDate', DateType::class,['label'=>'form.end'])
            ->add('note', TextareaType::class,['label'=>'form.note','required'=>''])
            ->add('save', SubmitType::class, array('label' => 'form.save')
            ->add('reset',Resettype::class,array('label'=>'form.reset'))
            ->getForm();

        $form->handleRequest($request);//lay request

    if ($form->isSubmitted() && $form->isValid()) {

        $task = $form->getData();

    if ($form->getClickedButton() && 'logout' === $form->getClickedButton()->getName())
           
        {return $this->redirectToRoute('logout');}
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return $this->redirectToRoute('show');
    }

        return $this->render('form/newform.html.twig', array(
            'form' => $form->createView(),
        ));
   }
   /**
     * @Route("/{_locale}/data/{person}",name="data")//duong dan
     */


  public function editAction($person,Request $request)//HIEN DATA CU THE
 {
    
    $product = $this->getDoctrine()
        ->getRepository(Task::class)
         ->findOneByPerson($person);
          if (!$product) {
        throw $this->createNotFoundException(
            'No product found for '.$person
        );
    }
         $form = $this->createFormBuilder($product)

            ->add('task', TextType::class,['label'=>'form.project'])
            ->add('person', TextType::class,['label'=>"form.work"])
            ->add('dueDate', DateType::class,['label'=>'form.begin'])
            ->add('endDate', DateType::class,['label'=>'form.end'])
            ->add('note', TextareaType::class,['label'=>'form.note','required'=>''])
            ->add('save', SubmitType::class, array('label' => 'form.edit'))
            ->add('logout', SubmitType::class, array('label' => 'form.logout'))
            ->add('delete', SubmitType::class, array('label' => 'form.delete'))
            
            ->getForm();

 $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $task = $form->getData();
        if ($form->getClickedButton() && 'delete' === $form->getClickedButton()->getName())
{$em2 = $this->getDoctrine()->getManager();
$em2->remove($task);
        $em2->flush();
          
return $this->redirectToRoute('show');}
 if ($form->getClickedButton() && 'logout' === $form->getClickedButton()->getName())
        {return $this->redirectToRoute('logout');}

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        
return $this->redirectToRoute('show');
}

   

 return $this->render('form/editform.html.twig',
           array(
            'form' => $form->createView(),
        ));
     
   

    }
    /**
     * @Route("/{_locale}/show",name="show")//duong dan
     */
     public function showAction(Request $request)//HIEN DATA CHUNG
     {
$repositor= $this->getDoctrine()
        ->getRepository(Task::class)->findAll();
        return $this->render('form/data.html.twig',['wee'=>$repositor]);
     }
      /**
     * @Route("/deny",name="deny")//duong dan
     */
        public function denyAction(Request $request)//HIEN loi
     {
        return $this->render('form/deny.html.twig',[]);
     }
       /**
     * @Route("/logout",name="logout")//duong dan
     */
        public function logoutAction(Request $request)//logout
     {
        return $this->redirectToRoute('login');
     }
      /**
     * @Route("/{_locale}/show/{person}",name="database")//duong dan
     */
     public function viewAction($person,Request $request)//HIEN DATA 
     {
$get= $this->getDoctrine()
        ->getRepository(Task::class)
         ->findOneByPerson($person);
          if (!$get) {
        throw $this->createNotFoundException(
            'No product found for '.$person
        );}
        return $this->render('form/showdata.html.twig',['getits'=>$get]);
     }
  
}