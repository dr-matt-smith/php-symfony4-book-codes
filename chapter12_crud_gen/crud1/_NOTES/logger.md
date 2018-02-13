
use Psr\Log\LoggerInterface;


    public function delete(LoggerInterface $logger, Request $request, Category $category)
    {
        $logger->info('1 :: got here');

        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);

        $logger->info('2 :: isSubmitted = ' . $form->isSubmitted());

        if ($request->isMethod('DELETE')) {


===

catch exception - foreign key violation


                try
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($category);
                    $em->flush();

                } catch(\Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $e)
                {
                    return new Response('could not delete record - would violate foreign key constrain ...');
                }

