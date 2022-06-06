<?php


namespace Graficart\RecaptchaBundle\Constraints;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use ReCaptcha\ReCaptcha;
class RecaptchaValidator extends ConstraintValidator
{
    /*
     * /@var RequestStack
    */
    private $requestStack;
    /*
     * @var \ReCaptcha\ReCaptcha
    */
    private $reCaptcha;

    /**
     * Checks if the passed value is valid.
     * @param RequestStack $requestStack
     * @param \ReCaptcha\ReCaptcha $reCaptcha
     */
    public function __construct(RequestStack $requestStack,ReCaptcha $reCaptcha)
    {
  $this->requestStack=  $requestStack;
    $this->reCaptcha=$reCaptcha;
    }


    public function validate($value, Constraint $constraint)
    {
    $request=$this->requestStack->getCurrentRequest();
    $recaptchaResponse=   $this->requestStack->getCurrentRequest()->request->get('g-recaptcha-response');
    if (empty($recaptchaResponse))
    {
       $this->context->buildViolation($constraint->message)->addViolation();
        return;
    }
    $response= $this->reCaptcha
        ->setExpectedHostname($request->getHost())
        ->verify($recaptchaResponse,$request->getClientIp());
    dump($this->reCaptcha);
    dump ($request->getHost());
    dump ($request->getClientIp());
    dd($response);

    if (!$response->isSuccess())
    {
        $this->context->buildViolation($constraint->message)->addViolation();
        return;

    }
    }

}